<?php require base_path('views/partials/auth/auth.php') ?>
    <main style="font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px;">
        <h1 style="color: #333; text-align: center; margin-bottom: 30px; font-size: 2.5em; font-weight: 700;">Training Session Details</h1>

        <section style="background: #ffffff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <h2 style="color: #1f2937; margin-bottom: 25px; font-size: 1.8em; font-weight: 600;">Session Information</h2>

            <div style="display: grid; gap: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; padding: 12px 0;">
                    <span style="font-weight: 600; color: #374151; font-size: 1.1em;">Session Name:</span>
                    <span style="color: #6b7280; font-size: 1.1em;"><?= $training_session['name'] ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; padding: 12px 0;">
                    <span style="font-weight: 600; color: #374151; font-size: 1.1em;">Date:</span>
                    <span style="color: #6b7280; font-size: 1.1em;"><?= date('d-m-Y', strtotime($training_session['date'])) ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; padding: 12px 0;">
                    <span style="font-weight: 600; color: #374151; font-size: 1.1em;">Time:</span>
                    <div style="color: #6b7280; font-size: 1.1em;">
                        <span><?= date('H:i A', strtotime($training_session['start_time'])) ?></span> -
                        <span><?= date('H:i A', strtotime($training_session['end_time'])) ?></span>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; padding: 12px 0;">
                    <span style="font-weight: 600; color: #374151; font-size: 1.1em;">Location:</span>
                    <span style="color: #6b7280; font-size: 1.1em;"><?= $training_session['venue'] ?></span>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: center;">
                <?php if(!$already_registered): ?>
                    <a href="/students/training_sessions/register?id=<?= $training_session['id'] ?>" class="button">
                        <button>
                            Register for Session
                        </button>
                    </a>
                <?php elseif(!$already_registered['attended']): ?>

                    <button id="markAttendance" class="button">
                        Mark Attendance
                    </button>
                <?php else: ?>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 15px; background-color: #E8F5E9; border-radius: 8px; border: 1px solid #4CAF50; color: #2E7D32; font-weight: 500;">
                        <i class="fa-solid fa-circle-check" style="color: #4CAF50; font-size: 1.3rem"></i>
                        <span>Attendance Marked</span>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section id="scannerSection" style="display: none; margin-top: 30px; background: #ffffff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center;">
            <h3 style="color: #1f2937; margin-bottom: 20px; font-size: 1.5em; font-weight: 600;">Scan QR Code for Attendance</h3>
            <video id="video" style="display: none;"></video>
            <canvas id="canvas" style="display: block; max-width: 100%; border-radius: 10px; margin: 0 auto;"></canvas>
            <div id="result" style="margin-top: 20px; color: #6b7280; font-size: 1.1em;"></div>
            <button id="restart" style="display: none; background: #e5e7eb; color: #374151; padding: 10px 20px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; margin-top: 20px; transition: background 0.3s;">
                Restart Scanner
            </button>

            <form id="attendance_form" action="/students/training_sessions/attendance" method="POST">
                <input id="attendance_code_input" type="hidden" name="attendance_code" />
                <input type="hidden" name="training_session_id" value="<?= $training_session['id'] ?>" />
            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>

    <script>
        const markAttendanceButton = document.getElementById('markAttendance');
        const scannerSection = document.getElementById('scannerSection');
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const resultDiv = document.getElementById('result');
        const restartButton = document.getElementById('restart');
        const ctx = canvas.getContext('2d');
        let stream = null;

        async function startQRScanner() {
            scannerSection.style.display = 'block';
            resultDiv.textContent = 'Scanning for QR code...';

            async function initializeStream() {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: 'environment' }
                    });
                    video.srcObject = stream;
                    await video.play();
                    console.log('Camera stream initialized');
                    return true;
                } catch (err) {
                    resultDiv.textContent = `Error accessing camera: ${err.message}`;
                    console.error('Camera error:', err);
                    return false;
                }
            }

            function stopStream() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                    console.log('Camera stream stopped');
                }
            }

            video.onloadedmetadata = () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                console.log(`Canvas set to ${canvas.width}x${canvas.height}`);
                scanQRCode();
            };

            video.onerror = () => {
                resultDiv.textContent = 'Video stream error';
                console.error('Video error occurred');
                stopStream();
                restartButton.style.display = 'block';
            };

            async function scanQRCode() {
                try {
                    if (!stream) {
                        console.warn('No active stream, stopping scan');
                        return;
                    }
                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    const code = jsQR(imageData.data, imageData.width, imageData.height);
                    if (code) {
                        // resultDiv.textContent = `QR Code detected: ${code.data}`;
                        // console.log('QR Code detected:', code.data);
                        stopStream();
                        restartButton.style.display = 'block';

                        // Send POST form
                        if (code.data !== '') {
                            try {
                                document.getElementById('attendance_code_input').value = code.data;
                                document.getElementById('attendance_form').submit();
                            } catch (err) {
                                resultDiv.textContent = `Error: ${err.message || 'Failed to submit attendance'}`;
                                resultDiv.style.color = '#ef4444';
                                console.error('Fetch error:', err);
                            }
                        } else {
                            console.log('empty qr code form not submitted')
                        }
                        return;
                    }
                    requestAnimationFrame(scanQRCode);
                } catch (err) {
                    console.error('Error in scanQRCode:', err);
                    resultDiv.textContent = `Scan error: ${err.message}`;
                    resultDiv.style.color = '#ef4444';
                    stopStream();
                    restartButton.style.display = 'block';
                }
            }

            if (await initializeStream()) {
                setInterval(() => {
                    if (video.paused || video.ended) {
                        console.warn('Video paused or ended, attempting to restart');
                        video.play().catch(err => console.error('Play error:', err));
                    }
                }, 1000);
            }

            restartButton.addEventListener('click', async () => {
                restartButton.style.display = 'none';
                resultDiv.textContent = 'Scanning for QR code...';
                resultDiv.style.color = '#6b7280';
                if (await initializeStream()) {
                    scanQRCode();
                }
            });
        }

        if (markAttendanceButton) {
            markAttendanceButton.addEventListener('click', startQRScanner);
        }
    </script>

<?php require base_path('views/partials/auth/auth-close.php') ?>