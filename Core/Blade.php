<?php

namespace Core;

class Blade {
    protected $viewsPath;
    protected $cachePath;
    protected $components = [];

    public function __construct($viewsPath, $cachePath) {
        $this->viewsPath = rtrim($viewsPath, '/');
        $this->cachePath = rtrim($cachePath, '/');
    }

    public function make($view, $data = []) {
        $cachedFile = $this->getCachedFilePath($view);

        if (!$this->isCached($view) || $this->isExpired($view)) {
            $content = $this->getFileContent($view);
            $content = $this->compileContent($content);
            file_put_contents($cachedFile, $content);
        }

        return $this->evaluateView($cachedFile, $data);
    }

    public function component($name, $viewOrCallback) {
        $this->components[$name] = $viewOrCallback;
    }

    protected function getCachedFilePath($view) {
        return $this->cachePath . '/' . md5($view) . '.php';
    }

    protected function isCached($view) {
        return file_exists($this->getCachedFilePath($view));
    }

    protected function isExpired($view) {
        $cachedFile = $this->getCachedFilePath($view);
        $originalFile = $this->viewsPath . '/' . $view . '.blade.php';
        return filemtime($originalFile) > filemtime($cachedFile);
    }

    protected function getFileContent($view) {
        $file = $this->viewsPath . '/' . $view . '.blade.php';
        return file_get_contents($file);
    }

    protected function compileContent($content) {
        $content = $this->compileComponents($content);
        $content = $this->compileEchos($content);
        $content = $this->compileStatements($content);
        return $content;
    }

    protected function compileComponents($content) {
        $pattern = '/<x-(\w+)(?:\s+([^>]*))?(?:>(.*?)<\/x-\1>|\s*\/>)/s';
        return preg_replace_callback($pattern, function($matches) {
            $name = $matches[1];
            $attributes = isset($matches[2]) ? $this->parseAttributes($matches[2]) : [];
            $slot = isset($matches[3]) ? $matches[3] : '';

            return "<?php echo \$this->renderComponent('$name', " . var_export($attributes, true) . ", '$slot'); ?>";
        }, $content);
    }

    protected function parseAttributes($attributeString) {
        $attributes = [];
        $pattern = '/(\w+)=([\'"])(.*?)\2/';
        preg_match_all($pattern, $attributeString, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $attributes[$match[1]] = $match[3];
        }
        return $attributes;
    }

    protected function renderComponent($name, $attributes, $slot) {
        if (!isset($this->components[$name])) {
            throw new Exception("Component '$name' not found.");
        }

        $component = $this->components[$name];

        if (is_callable($component)) {
            return $component($attributes, $slot);
        } else {
            $data = array_merge($attributes, ['slot' => $slot]);
            return $this->make($component, $data);
        }
    }

    protected function compileEchos($content) {
        $pattern = '/\{\{\s*(.+?)\s*\}\}/';
        return preg_replace($pattern, '<?php echo htmlspecialchars($1, ENT_QUOTES, \'UTF-8\'); ?>', $content);
    }

    protected function compileStatements($content) {
        $statements = [
            '/\@if\s*\((.*?)\)/' => '<?php if ($1): ?>',
            '/\@else/' => '<?php else: ?>',
            '/\@elseif\s*\((.*?)\)/' => '<?php elseif ($1): ?>',
            '/\@endif/' => '<?php endif; ?>',
            '/\@foreach\s*\((.*?)\)/' => '<?php foreach ($1): ?>',
            '/\@endforeach/' => '<?php endforeach; ?>',
        ];

        foreach ($statements as $pattern => $replacement) {
            $content = preg_replace($pattern, $replacement, $content);
        }

        return $content;
    }

    protected function evaluateView($__file, $__data) {
        extract($__data);
        ob_start();
        include $__file;
        return ob_get_clean();
    }
}

// Usage example:
// $blade = new SimpleBlade('/path/to/views', '/path/to/cache');
// $blade->component('button', 'components.button');
// echo $blade->make('welcome', ['name' => 'John Doe']);