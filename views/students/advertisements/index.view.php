<?php require base_path('views/partials/auth/auth.php') ?>


<main>
    <div class="container">
        <div style="margin-top: 1rem">
            <div style="display: flex; gap: 10px; justify-content: space-between">
                <span style="font-size: 2rem">Advertisements</span>

                <?php if (!empty($companies)): ?>
                    <form action="/students/advertisements" method="get" style="display: flex; gap: 0.5rem">
                        <div>
                            <div class="select">
                                <select name="company_id" class="select">
                                    <option value="">Select Company</option>
                                    <?php foreach ($companies as $company): ?>
                                        <option value="<?= $company['id'] ?>">
                                            <?= $company['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="down_note"></div>
                        </div>

                        <button type="submit" class="button">Filter</button>
                        <a href="/students/advertisements" style="display: flex">
                            <button type="button" class="button">Clear</button>
                        </a>
                    </form>
                <?php endif; ?>
            </div>

        </div>

        <?php if (!$currentRound): ?>
            <div style="margin-top: 10rem; display: flex; justify-content: center; width: 100%;">
                <h1>A round has not started yet</h1>
            </div>
        <?php endif; ?>
        <div class="job-grid">
            <?php foreach ($ads as $item): ?>
                <div class="job-card">
                    <div class="job-header">
                        <div>
                            <a href="/students/companies/show?id=<?= $item['user_id'] ?>">
                                <span><?= $item['name'] ?></span>
                            </a>
                            <br />
                            <span style="font-size: 0.7rem; color: var(--gray-400)"><?= $item['building'] ?>,
                                <?= $item['street_name'] ?>,
                                <?= $item['city'] ?>
                            </span>
                        </div>
                        <a href="/students/advertisements/show?id=<?= $item['id'] ?>">
                            <button type="button" class="button">Apply</button>
                        </a>
                    </div>

                    <div class="job-details">
                        <h1 class="job-title"><?= $item['job_role'] ?></h1>
                        <p class="job-description"><?= $item['responsibilities'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tristique vulputate ligula sed ultrices. Aenean sed diam rutrum, vestibulum orci ut, cursus ipsum. Nam eget convallis nisl. Donec vel urna eros. Vestibulum sodales lectus a sem luctus auctor. Maecenas fermentum ornare iaculis. Maecenas in arcu ut augue maximus condimentum.

Sed neque ipsum, mattis nec est sit amet, tristique lobortis turpis. Sed vel massa sed lectus facilisis volutpat a non ligula. Cras varius lacus quis vulputate vestibulum. Etiam tempor ut velit ac tincidunt. Etiam eu pretium arcu, at finibus tortor. Aenean id arcu gravida, malesuada arcu ut, mollis arcu. Cras lobortis risus id augue finibus egestas. Donec et quam ut massa consectetur gravida. Integer eget tortor in sem consequat efficitur. Cras scelerisque molestie diam, eget consectetur mi posuere sit amet. In ut dolor in ipsum auctor bibendum. Proin venenatis tortor a lorem vulputate, nec efficitur ipsum sagittis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec auctor tortor ipsum, ut molestie ipsum porta nec. Praesent semper sollicitudin elit, et dignissim tortor tempus at. Sed sed euismod erat.

Donec viverra tristique nulla non rhoncus. Etiam fringilla iaculis nisl, at iaculis enim rhoncus non. Sed in purus at ipsum efficitur aliquam. Morbi nec eros nisi. Suspendisse quis massa eleifend, faucibus ante sit amet, ultricies neque. Vestibulum ullamcorper ex vitae orci efficitur, in tempus mauris congue. Fusce auctor in lacus vitae cursus.

Aenean sed semper arcu, sit amet fermentum nisl. Aliquam porta lectus nec facilisis aliquet. Sed non auctor tortor. Suspendisse aliquet suscipit tellus eget suscipit. Vivamus nec ornare mi. Morbi eget odio eu felis tempor congue. Donec quis efficitur nulla. Ut consequat id leo at porta. Nunc vitae laoreet nisi.

Morbi elementum diam at nibh viverra eleifend. Pellentesque sollicitudin massa risus, vel pulvinar elit bibendum at. Ut posuere vitae dui quis imperdiet. Suspendisse vitae porttitor dolor. Aliquam aliquet convallis neque, eu porta tortor sollicitudin quis. Sed a felis in purus consectetur molestie. Pellentesque eleifend mi leo. Etiam nec eros feugiat, porta tellus ac, rutrum dui. Mauris efficitur purus sed neque interdum bibendum. Maecenas ultrices interdum lorem, in vulputate nisl eleifend vel.

Maecenas ac pulvinar orci. Ut eros velit, auctor ut iaculis at, scelerisque at nibh. Suspendisse et est quis neque tempor sodales. Ut in luctus enim. Morbi auctor erat finibus, euismod nisi non, ultrices mi. Donec sed risus massa. Etiam ut elit sit amet dui ultricies porttitor vitae at nunc. Duis gravida, ipsum placerat pharetra pretium, ex nibh blandit ligula, sit amet hendrerit mi risus sed nulla. Maecenas tristique ligula tortor, eu eleifend lacus faucibus nec. Nulla consequat et arcu sed congue.

Mauris nibh neque, sollicitudin porta turpis id, pretium consequat quam. Duis lacinia placerat leo. Maecenas dapibus vehicula justo, ac luctus elit mattis varius. Ut maximus quis nisl id efficitur. Sed molestie sagittis tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus id velit eu augue egestas pellentesque quis a ipsum. Maecenas convallis arcu purus, sit amet pharetra sapien mollis ut. Fusce vel faucibus nunc, quis dapibus tortor. Nulla facilisi. Proin viverra urna eu quam feugiat, quis dignissim sapien condimentum.

Mauris sed egestas magna, non venenatis metus. Phasellus mauris sapien, finibus pretium varius non, lobortis quis arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque sed blandit magna, sed rutrum eros. Cras orci sem, mollis a ullamcorper vel, tincidunt at nulla. Etiam eu nisl nulla. Fusce euismod pretium est at tincidunt. Integer nec porta nisi. Aenean elementum est ac metus dictum rutrum. Suspendisse tincidunt tincidunt molestie. Nam vel rhoncus odio. Nunc suscipit eros ultricies dignissim ullamcorper. Integer aliquet sem elit, a finibus felis tempor eget. Integer pharetra sagittis consectetur.

Etiam eget est vitae augue interdum porttitor eget vel dui. Nulla ac pharetra felis, fermentum porttitor mauris. Praesent in egestas ipsum. Nullam et metus in sem eleifend porttitor. Quisque nunc diam, posuere a aliquet at, fermentum at metus. Duis feugiat tincidunt luctus. Etiam gravida laoreet congue. Donec lacus erat, aliquam ac condimentum at, lacinia in dolor. Duis maximus egestas urna nec sollicitudin. Nunc auctor vehicula neque, sit amet tristique tortor congue ultricies.

Mauris rutrum pellentesque dui, at scelerisque enim sagittis sit amet. Mauris ac ornare ligula, ultricies bibendum libero. Sed ut ante fermentum, convallis mi quis, vulputate eros. Nulla felis nunc, mattis sit amet diam finibus, tincidunt ullamcorper eros. Integer convallis enim imperdiet ex dignissim mollis. Nam porta, turpis at consequat auctor, leo quam vehicula eros, eget luctus ex turpis sit amet magna. Aenean tempor lectus dui, ut hendrerit diam eleifend quis.

Nulla nec magna orci. Donec ullamcorper feugiat fringilla. Nulla leo mauris, egestas quis enim id, sodales mattis sem. Quisque ut eleifend dui. Integer feugiat, libero in convallis cursus, tellus eros rutrum nisi, ac molestie nunc quam at elit. Vestibulum imperdiet ultricies mi ac scelerisque. Vestibulum blandit ac nunc sed convallis. Proin lectus sem, tincidunt ut urna at, interdum faucibus augue.

Nulla a feugiat dolor. Proin pulvinar interdum ante. Phasellus ut semper mi. Sed non maximus turpis, vel facilisis nulla. Vestibulum volutpat rutrum nisi. Nulla laoreet sit amet libero id convallis. Nam laoreet efficitur mattis. Mauris dictum nisl massa, ac bibendum sem accumsan tempor. Sed ac libero tristique tellus sollicitudin suscipit.

Duis et ipsum sed mi pretium mollis aliquet a sem. Duis non sagittis odio. Aliquam tempus ullamcorper pulvinar. Pellentesque gravida faucibus fermentum. Aenean vitae ullamcorper augue. Nunc tempus, magna id elementum aliquam, velit ex sodales nulla, quis elementum lacus magna vitae enim. Sed quis euismod tellus, sed congue est. Aenean auctor nulla libero, at tincidunt lorem ullamcorper molestie. Aenean quis risus finibus, lacinia ex vel, hendrerit ante.

Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec maximus euismod est et varius. In nec fermentum sem. Mauris bibendum, lorem at consequat maximus, erat ligula aliquet dolor, convallis porta sapien neque eget nisl. Praesent finibus mollis libero tristique interdum. Vivamus elementum massa gravida, feugiat nulla ut, porttitor leo. Duis ornare odio risus, sed vestibulum risus consequat at. Cras metus ante, dapibus quis volutpat id, lacinia eget mauris.

Sed mattis viverra erat, sed consequat dolor dapibus vel. Sed ut diam magna. Nunc vehicula sollicitudin tortor, at scelerisque diam euismod a. Suspendisse ultricies malesuada erat sed viverra. Etiam lacus lectus, luctus eget quam et, tincidunt dignissim tortor. Fusce condimentum, lorem ac interdum cursus, nibh neque finibus augue, at venenatis ex ex ac erat. Suspendisse potenti. Pellentesque sit amet sagittis mauris, vehicula tincidunt purus. In quis mauris vitae nulla pharetra tristique. Donec dui eros, blandit eu dignissim nec, cursus id nibh. Aenean nec metus et elit porttitor rhoncus. Duis aliquam venenatis dolor, nec tincidunt ante eleifend nec. Ut sodales egestas leo, quis condimentum metus pretium at.

Cras lobortis pharetra ligula, nec facilisis velit ultrices et. Phasellus eget nulla elit. Vivamus pharetra est a felis hendrerit, eu interdum nunc scelerisque. Phasellus faucibus metus ex, a porttitor ex faucibus sit amet. Fusce consequat diam vel lacus tincidunt ultrices eget eget ex. Praesent egestas dolor nisi, vitae consectetur ex bibendum id. Ut quis nisi leo. Mauris ullamcorper magna ligula, mollis lobortis est accumsan eget. Suspendisse imperdiet turpis eu rhoncus dapibus. Ut ut finibus nunc. Integer eu justo gravida, iaculis erat eget, rhoncus dolor. In placerat scelerisque varius. Donec dolor ex, tristique a pulvinar eu, interdum eget orci. Nam molestie fringilla nibh, sed consequat eros. Phasellus sed dui sem.

Nunc ipsum mauris, porttitor nec elit non, fringilla dignissim justo. Cras ornare tellus tortor, ut tempor enim bibendum et. Vivamus ipsum nisi, aliquam volutpat ultrices eget, lobortis quis dolor. Nullam ligula ligula, ullamcorper sed ornare id, facilisis vel leo. Morbi congue massa et dolor consectetur, ac lacinia sapien semper. Morbi eleifend suscipit porttitor. Vivamus semper urna eu venenatis blandit.

Etiam commodo porttitor fermentum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam suscipit risus sit amet augue vehicula maximus. Vivamus consequat ante eu diam porta sagittis. Suspendisse sit amet nulla pellentesque, scelerisque dolor sed, malesuada augue. Etiam consequat placerat viverra. Nam sagittis sem at mauris dignissim imperdiet. Pellentesque interdum felis neque, ut consectetur arcu rutrum vel.

Suspendisse ut facilisis eros. Donec lectus nisl, condimentum quis felis eget, lobortis condimentum massa. Ut ligula ligula, molestie sit amet est a, dictum fringilla velit. Suspendisse tempus nulla sit amet dapibus dignissim. Nulla dignissim a ex eget mattis. Ut sodales consectetur lacus, sed venenatis est luctus id. Nullam at arcu a enim maximus maximus non vel velit.

Aliquam eu sagittis tortor. Nulla facilisis diam a metus bibendum, a euismod erat rutrum. Proin eget posuere odio. Pellentesque tincidunt neque magna, eget porta purus viverra eu. Nulla iaculis, ante a rhoncus pulvinar, massa enim convallis justo, eget varius est eros vel elit. Nulla gravida, risus eu elementum auctor, massa ipsum eleifend mi, eu accumsan velit risus bibendum justo. In facilisis at orci eu ornare. Pellentesque luctus quis tortor ut interdum. Mauris in metus in lorem posuere sagittis vitae in dui. In hac habitasse platea dictumst. Quisque urna leo, mattis non volutpat nec, commodo nec eros. Donec tortor ipsum, ullamcorper eleifend lacinia in, elementum imperdiet libero.

Integer maximus porta arcu et euismod. Etiam placerat odio sed ex vulputate sollicitudin. Sed sodales orci non venenatis hendrerit. Vivamus elementum mi at justo viverra pulvinar. Nunc ac vestibulum purus. Curabitur elit ipsum, ornare ut pellentesque quis, malesuada a enim. Aenean finibus malesuada malesuada. Aenean sit amet sagittis est. Nunc vel nunc eget ipsum tincidunt eleifend at luctus enim. Mauris aliquet venenatis leo, non efficitur eros imperdiet id. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus pellentesque fringilla augue. Integer et volutpat turpis.

Integer erat justo, iaculis ut vehicula non, auctor eget ligula. Suspendisse in euismod eros. Nullam aliquet neque vel massa semper, lacinia rutrum orci vulputate. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt dui tortor, eu ornare felis pulvinar vel. Mauris tincidunt mattis diam eu consequat. Vivamus arcu ex, consectetur vel nisl ornare, vehicula sollicitudin ex. Maecenas convallis pulvinar eros, at finibus leo porta eget. Mauris non hendrerit metus, ac auctor neque. Cras libero ante, egestas quis gravida nec, tincidunt in metus. Ut volutpat turpis eu felis rhoncus faucibus. Praesent lobortis dignissim mauris, sed pulvinar est luctus nec. Aenean eu ex rhoncus, sollicitudin leo nec, tristique nulla.

Pellentesque aliquet gravida lectus, nec laoreet lectus cursus vel. Sed nibh eros, dictum et justo id, interdum iaculis quam. Suspendisse vel hendrerit velit. Phasellus scelerisque nisi in facilisis ullamcorper. Aenean et sem ut libero venenatis venenatis id vel erat. Etiam consequat, dolor vitae vehicula varius, nisi metus posuere risus, sit amet finibus sem ex eu sapien. Quisque lacinia ultricies odio, sed tristique nisi molestie vitae. Sed ultrices id massa consequat bibendum. Mauris vehicula orci et nisi iaculis, sed facilisis sapien sagittis. Nunc est nisl, pharetra non ligula a, lacinia bibendum mauris. Sed mollis tortor ac massa euismod aliquet. Fusce in nisl ex. Phasellus et metus fermentum est gravida porta vitae vel justo. Mauris sagittis mi augue, at eleifend lectus blandit eget. Nam eget tristique lectus. Curabitur pulvinar auctor ante, eget ullamcorper tortor faucibus a.

Praesent ultricies tellus felis, eu vulputate eros elementum sed. Nam porta felis est, non lobortis mauris consequat vel. Sed id pulvinar ante. Nulla molestie sem eu ante tincidunt, eget maximus urna ultrices. Vestibulum sollicitudin ultrices odio, vitae commodo nisi tristique nec. Duis sed fringilla massa, ac pretium tortor. Ut vulputate enim at ligula fermentum, a accumsan ante dictum. Quisque pharetra ante arcu, ut elementum libero molestie id. Suspendisse cursus risus sed libero feugiat, quis ornare felis convallis. Proin ac iaculis eros.

Proin tincidunt est non ultricies malesuada. Maecenas aliquet nisi elit, sit amet tincidunt libero lobortis id. In ultrices sed tellus placerat vestibulum. Etiam scelerisque faucibus interdum. Aliquam sed auctor nulla, et finibus lorem. Mauris aliquam eu orci a mollis. Vivamus molestie feugiat sapien tempus consectetur. Fusce hendrerit, turpis ac tincidunt ornare, augue dui interdum ante, rutrum eleifend orci augue ut neque. Aliquam viverra risus nisl, ut semper ipsum elementum ullamcorper. Suspendisse sed risus pretium sem lobortis pharetra. Donec volutpat ipsum ut blandit placerat. Etiam tristique, dui quis finibus cursus, lectus mi rutrum turpis, hendrerit hendrerit erat nunc vel nibh. In hac habitasse platea dictumst.

Nam quis vehicula sem. Aliquam tristique nulla sodales leo rhoncus, in rutrum orci efficitur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor lacus ut massa elementum, ut bibendum urna eleifend. Duis eget metus nec dui sodales consequat. Etiam bibendum suscipit augue eget dapibus. Nam finibus bibendum magna, ac feugiat nulla egestas tempus. Praesent blandit, purus nec commodo feugiat, velit mi pulvinar purus, non sagittis mi ante eu nisl. Proin eget dapibus nisi. Donec ex urna, lobortis at consectetur at, accumsan eu quam. Mauris sit amet augue id enim interdum sollicitudin.

Nam dictum elit in elementum blandit. Quisque ac porta lacus. Mauris rhoncus, augue a imperdiet blandit, felis ligula condimentum tellus, sit amet tristique libero leo id ipsum. Aenean congue magna a est consequat tempor. Proin quis euismod felis, sit amet lacinia lorem. Sed euismod tellus a egestas sollicitudin. Aliquam sed leo tempor, molestie enim in, auctor mauris. Nullam rutrum facilisis magna nec tincidunt. Nunc et iaculis purus.

Donec quis ipsum tristique, pretium ex id, venenatis turpis. Phasellus imperdiet nibh in blandit vestibulum. Nunc in lorem consequat, lobortis magna eget, feugiat elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean pharetra pharetra arcu, a molestie erat auctor vel. Donec id vulputate quam. Cras posuere erat tellus, sodales scelerisque ex mollis sed. Mauris tincidunt gravida commodo. Nunc quis augue accumsan, hendrerit lectus non, consectetur massa. Curabitur nibh lectus, efficitur sed metus ac, vestibulum dapibus ex. Ut eget pellentesque est, ac pharetra magna. Sed vitae augue neque.</span>
</main>

<link rel="stylesheet" href="/styles/thathsara/thathsara4.css">
<link rel="stylesheet" href="/styles/select.css">

<?php require base_path('views/partials/auth/auth-close.php') ?>