<div class="js-fix-footer footer border-top-2">
    {{--    <div class="container page__container page-section d-flex flex-column">--}}
    {{--        <p class="text-70 brand mb-24pt">--}}
    {{--            <img class="brand-icon" src="{{asset('theme/images/black-70@2x.png')}}" width="30" alt="Huma"> Huma--}}
    {{--        </p>--}}
    {{--        <p class="measure-lead-max text-muted mb-0 small">Huma is a beautifully crafted user interface for--}}
    {{--            modern Business Admin Web Applications, with examples for many pages needed for Customer--}}
    {{--            Relationship Management, Enterprise Resource Planning, Human Resources, Content Management System,--}}
    {{--            Project Management, Tasks, eCommerce, Messaging and Account Management.</p>--}}
    {{--    </div>--}}
    <div class="pb-16pt pb-lg-24pt">
        <div class="container page__container">
            <div class="bg-dark rounded page-section py-lg-32pt px-16pt px-lg-24pt">
                <canvas id="canvas-footer"></canvas>
                <div class="row">
                    <div class="col-md-4 col-sm-8 mb-24pt mb-md-0">
                        <p class="text-white-70 mb-8pt"><strong>Мы в соц.сетях</strong></p>
                        <nav class="nav nav-links nav--flush">
                            <div class="contact-icon">
                                <a href="https://vk.me/3d.mitra" target="_blank"> <i class="fab fa-vk"></i> </a>
                                <a href="https://wa.me/79777528440" target="_blank"> <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="https://t.me/Aleksandra_Dmitrovskaya" target="_blank"> <i
                                        class="fab fa-telegram"></i> </a>
                                <a href="https://viber.click/79777528440" target="_blank"> <i class="fab fa-viber"></i></a>
                                <a href="https://www.instagram.com/3d_mitra" target="_blank"> <i class="fab"></i> </a>
                            </div>


                            <!-- <a href="#" class="nav-link"><img src="assets/images/icon/footer/youtube-square@2x.png" width="24" height="24" alt="YouTube"></a> -->
                        </nav>
                    </div>
                    {{--                    <div class="col-md-6 col-sm-4 mb-24pt mb-md-0 d-flex align-items-center">--}}
                    {{--                        <a href="" class="btn btn-outline-white">English <span--}}
                    {{--                                class="icon--right material-icons">arrow_drop_down</span></a>--}}
                    {{--                    </div>--}}
                    <div class="col-md-4">
                        <img src="https://3d-mitra.ru/wp-content/uploads/2019/12/3D-Mitra-logo-white.png" alt="" style="
                            max-width: 250px;
                        ">
                    </div>
                    <div class="col-md-4 text-md-right">

{{--                        <p class="mb-8pt d-flex align-items-md-center justify-content-md-end">--}}
                            <a href="https://3d-mitra.ru/wp-content/uploads/2018/06/Оферта-3D-Mitra.pdf" class="text-white-70 text-underline mr-16pt">Оферта</a>
                            <a href="" class="text-white-70 text-underline">Пользовательское соглаешение</a>
{{--                        </p>--}}
                        <p class="text-white-50 small mb-0">Copyright 2020 &copy; All rights reserved.</p>
                    </div>







                    <style>
                        .contact-icon {
                            font-size: 25px;
                        }

                        .contact-icon > a > i {
                            color: #303840;
                            background-color: #bec1c3;
                            width: 35px;
                            padding: 4px;
                            border-radius: 10px;
                        }

                        #canvas-footer {
                            /*     background: #1d0b0b; */
                            position: absolute;
                            left: 25px;
                            top: 0;
                        }
                    </style>
                    <script>
                        let canvas = document.getElementById("canvas-footer"),
                            ctx = canvas.getContext("2d"),
                            w,
                            h,
                            particles = [],
                            maxParticles = 30,
                            radius = 3;

                        const Tau = Math.PI * 2,
                            ConnectionDist = 300,
                            Msqrt = Math.sqrt,
                            Mrandom = Math.random;
                        // document.querySelector('footer.footer.footer-black.footer-big').onmousemove =  connectMouse;
                        // canvas
                        function connectMouse(e) {
                            let p0 = particles[0];
                            p0.x = e.offsetX;
                            p0.y = e.offsetY;
                        }

                        function handleResize() {
                            w = ctx.canvas.width = document.querySelector('.bg-dark.rounded.page-section').clientWidth;
                            h = ctx.canvas.height = document.querySelector('.bg-dark.rounded.page-section').clientHeight;
                        }

                        window.onresize = () => handleResize();
                        handleResize();

                        function createParticles() {
                            let vRange = 1,
                                vModifier = .5;
                            for (let i = 0; i < maxParticles; i++) {
                                particles.push({
                                    x: Mrandom() * w - radius,
                                    y: Mrandom() * h - radius,
                                    xv: Mrandom() * vRange - vModifier,
                                    yv: Mrandom() * vRange - vModifier,
                                    strokeColour: {h: 0, s: 1}
                                });
                            }
                        }

                        function update() {
                            let p;
                            for (i = 0; i < particles.length; i++) {
                                p = particles[i];
                                // move
                                p.x += p.xv;
                                p.y += p.yv;
                                // keep in bounds
                                if (p.x < 0) {
                                    p.x = 0;
                                    p.xv *= -1;
                                } else if (p.x > w) {
                                    p.x = w;
                                    p.xv *= -1;
                                }
                                if (p.y < 0) {
                                    p.y = 0;
                                    p.yv *= -1;
                                } else if (p.y > h) {
                                    p.y = h;
                                    p.yv *= -1;
                                }
                            }
                        }

                        function connect() {
                            let p1, p2;
                            for (let i = 0; i < maxParticles - 1; i++) {
                                p1 = particles[i];
                                for (let j = i + 1; j < maxParticles; j++) {
                                    p2 = particles[j];
                                    currentDist = dist(p2.x, p1.x, p2.y, p1.y);
                                    if (currentDist < ConnectionDist) {
                                        ctx.beginPath();
                                        ctx.moveTo(p1.x, p1.y);
// 				ctx.strokeStyle = 'hsla('+p1.strokeColour.h+', 50%, 50%, ' + (1 - currentDist * 0.003) + ')';
                                        ctx.strokeStyle = 'hsla(333, 47%, 34%, ' + (1 - currentDist * 0.005) + ')';
                                        ctx.lineTo(p2.x, p2.y, p1.x, p1.y);
                                        ctx.stroke();
                                    }
                                }
                            }
                        }

                        function draw() {
                            let p, d;
                            for (let loop = particles.length, i = 0; i < loop; i++) {
                                p = particles[i];
                                d = dist(0, p.x, h, p.y);
                                // p.fillColour = 'hsla(' + d + ' , 50%, 30%, 1)';
                                p.fillColour = 'hsla(337 , 20%, 30%, 1)';
                                p.strokeColour = {h: d, s: (d * .01)};
                                ctx.beginPath();
                                ctx.fillStyle = p.fillColour;
                                ctx.arc(p.x, p.y, radius, 0, Tau);
                                ctx.fill();
                            }
                        }

                        function dist(x1, x2, y1, y2) {
                            let a = x1 - x2,
                                b = y1 - y2;
                            return Msqrt(a * a + b * b);
                        }

                        function animate() {
                            canvas.width = w;
                            update();
                            connect();
                            draw();
                            requestAnimationFrame(animate);
                        }

                        createParticles();
                        animate();
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
