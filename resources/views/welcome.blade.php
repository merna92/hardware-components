<x-layout.layout title="Home">

    {{-- Catalog Home Content --}}
    @include('catalog.home')

    {{-- Welcome Gift Modal - يظهر فقط لليوزر الجديد بعد التسجيل --}}
    @if(session('showWelcome'))

        {{-- Animations CSS --}}
        <style>
            @keyframes float3D {
                0%   { transform: translateY(0px) rotate(0deg); }
                50%  { transform: translateY(-10px) rotate(2deg); }
                100% { transform: translateY(0px) rotate(0deg); }
            }
            @keyframes pulseGlow {
                0%   { transform: scale(1); opacity: 0.85; }
                50%  { transform: scale(1.02); opacity: 1; }
                100% { transform: scale(1); opacity: 0.85; }
            }
            .animate-float    { animation: float3D 3.5s ease-in-out infinite; }
            .big-discount-banner {
                background: linear-gradient(135deg, #0c0b0b 0%, #ffb199 100%);
                box-shadow: 0 8px 20px rgba(255,8,68,0.3);
                animation: pulseGlow 2s infinite;
            }
            .copy-btn-pointer { cursor: pointer !important; transition: all 0.2s ease-in-out; }
            .copy-btn-pointer:hover { transform: scale(1.05); }
        </style>

        {{-- Modal HTML --}}
        <div class="modal fade" id="welcomeGiftModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width:440px;">
                <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden position-relative"
                     style="background:#ffffff; border:2px solid #f1f5f9;">

                    {{-- Gradient top bar --}}
                    <div style="height:6px; background:linear-gradient(90deg,#ff0844 0%,#ffb199 50%,#4facfe 100%);"></div>

                    {{-- Close button (visible on both light & dark) --}}
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 shadow-none z-3"
                            data-bs-dismiss="modal" aria-label="Close"
                            style="cursor:pointer; filter:invert(1) grayscale(100%) brightness(200%); opacity:0.8;"></button>

                    <div class="modal-body p-4 text-center">

                        {{-- Floating gift icon --}}
                        <div class="mb-2 position-relative d-inline-block">
                            <div class="position-absolute top-50 start-50 translate-middle rounded-circle"
                                 style="width:120px;height:120px;background:rgba(255,8,68,0.15);filter:blur(25px);"></div>
                            <img src="https://cdn-icons-png.flaticon.com/512/3081/3081840.png"
                                 alt="Welcome Gift"
                                 class="img-fluid position-relative z-1 animate-float"
                                 style="width:115px;height:115px;object-fit:contain;filter:drop-shadow(0 12px 16px rgba(0,0,0,0.18));">
                        </div>

                        {{-- Greeting --}}
                        <h3 class="fw-black text-dark mb-1" style="font-weight:800;">
                            Woohoo! Welcome {{ auth()->user()->first_name ?? '' }}! 🎉
                        </h3>
                        <p class="text-secondary small mb-3">
                            We are super excited to have you! Here is your exclusive VIP welcome offer:
                        </p>

                        {{-- 30% OFF Banner --}}
                        <div class="big-discount-banner text-white rounded-4 p-2 px-3 mb-3 text-center">
                            <div class="text-uppercase fw-extrabold fs-4" style="text-shadow:0 2px 4px rgba(0,0,0,0.2);">
                                💥 30% OFF YOUR FIRST ORDER! 💥
                            </div>
                        </div>

                        {{-- Promo Code --}}
                        <div class="p-3 rounded-4 text-white shadow-sm" style="background:#0f172a;">
                            <span class="text-white-50 small d-block mb-1 text-uppercase" style="font-size:0.75rem;">Your Personal Promo Code</span>
                            <div class="d-flex align-items-center justify-content-between bg-white bg-opacity-10 rounded-3 p-2 px-3">
                                <span class="fs-4 fw-bold text-warning font-monospace" id="modalPromoCode">WELCOME30</span>
                                <button class="btn btn-warning fw-bold px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2 copy-btn-pointer"
                                        onclick="copyModalCode(this)">
                                    <i class="bi bi-clipboard-check-fill" id="copyBtnIcon"></i>
                                    <span id="copyBtnText">Copy Code</span>
                                </button>
                            </div>
                        </div>

                        {{-- Dismiss button --}}
                        <button type="button" class="btn btn-danger w-100 rounded-pill py-2 fw-bold mt-3 shadow-sm"
                                data-bs-dismiss="modal" style="cursor:pointer;">
                            🛒 Start Shopping!
                        </button>

                    </div>
                </div>
            </div>
        </div>

        {{-- Confetti + auto-show --}}
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var welcomeModal = new bootstrap.Modal(document.getElementById('welcomeGiftModal'));
                welcomeModal.show();

                var duration  = 2500;
                var animEnd   = Date.now() + duration;
                var defaults  = { startVelocity:30, spread:360, ticks:60, zIndex:10000 };

                function rand(min,max){ return Math.random()*(max-min)+min; }

                var interval = setInterval(function(){
                    var left = animEnd - Date.now();
                    if(left <= 0){ return clearInterval(interval); }
                    var count = 50*(left/duration);
                    confetti(Object.assign({},defaults,{particleCount:count,origin:{x:rand(0.1,0.3),y:Math.random()-0.2}}));
                    confetti(Object.assign({},defaults,{particleCount:count,origin:{x:rand(0.7,0.9),y:Math.random()-0.2}}));
                }, 250);
            });

            function copyModalCode(btn){
                navigator.clipboard.writeText(document.getElementById('modalPromoCode').innerText);
                document.getElementById('copyBtnText').innerText = 'Copied!';
                document.getElementById('copyBtnIcon').className  = 'bi bi-check-lg';
                btn.classList.replace('btn-warning','btn-success');
            }
        </script>

    @endif

</x-layout.layout>
