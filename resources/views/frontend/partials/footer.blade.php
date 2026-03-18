<style>
/* ============================
   FOOTER
   ============================ */
.site-footer {
    background: #0d0e12;
    border-top: 1px solid rgba(255,255,255,0.06);
    padding: 80px 0 0;
    margin-top: 0;
    font-family: 'Inter', sans-serif;
}
.footer-inner {
    max-width: 1280px; margin: 0 auto; padding: 0 24px;
}
.footer-grid {
    display: grid;
    grid-template-columns: 1.8fr 1fr 1fr 1fr 1fr;
    gap: 48px; margin-bottom: 60px;
}
.footer-brand .footer-logo {
    display: flex; align-items: center; gap: 10px; margin-bottom: 18px;
    font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 22px; color: #fff;
}
.footer-logo-icon {
    width: 36px; height: 36px; border-radius: 9px;
    background: linear-gradient(135deg, #6c63ff, #ec4899);
    display: flex; align-items: center; justify-content: center; font-size: 17px; color: #fff;
}
.footer-logo span { background: linear-gradient(135deg, #6c63ff, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.footer-desc {
    color: #6b7080; font-size: 14px; line-height: 1.75; margin-bottom: 24px; max-width: 300px;
}

/* Newsletter */
.footer-newsletter { display: flex; gap: 0; }
.footer-newsletter input {
    flex: 1; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
    border-right: none; border-radius: 10px 0 0 10px; padding: 11px 16px;
    color: #fff; font-size: 13px; font-family: 'Inter', sans-serif; outline: none;
    transition: border-color 0.2s;
}
.footer-newsletter input:focus { border-color: rgba(108,99,255,0.5); }
.footer-newsletter input::placeholder { color: #4a5060; }
.footer-newsletter button {
    padding: 11px 18px; background: linear-gradient(135deg, #6c63ff, #a855f7);
    border: none; border-radius: 0 10px 10px 0; color: #fff; font-size: 13px;
    font-weight: 600; cursor: pointer; font-family: 'Inter', sans-serif; white-space: nowrap;
    transition: opacity 0.2s;
}
.footer-newsletter button:hover { opacity: 0.85; }

/* Social */
.footer-socials { display: flex; gap: 10px; margin-top: 20px; }
.footer-social {
    width: 36px; height: 36px; border-radius: 9px;
    background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.09);
    display: flex; align-items: center; justify-content: center; color: #6b7080; font-size: 15px;
    transition: all 0.2s;
}
.footer-social:hover { background: rgba(108,99,255,0.15); border-color: rgba(108,99,255,0.4); color: #6c63ff; }

/* Footer Columns */
.footer-col h4 {
    font-family: 'Outfit', sans-serif; font-size: 14px; font-weight: 700;
    color: #fff; margin-bottom: 18px; text-transform: uppercase; letter-spacing: 1px;
}
.footer-col ul { list-style: none; }
.footer-col ul li { margin-bottom: 10px; }
.footer-col ul li a { color: #6b7080; font-size: 13px; transition: color 0.2s; }
.footer-col ul li a:hover { color: #9397a8; }
.footer-col ul li a span.badge-new {
    display: inline-block; padding: 1px 7px; background: rgba(67,233,123,0.12);
    border: 1px solid rgba(67,233,123,0.25); color: #43e97b; border-radius: 50px;
    font-size: 10px; font-weight: 700; margin-left: 6px; vertical-align: middle;
}

/* App Badges */
.footer-apps { display: flex; flex-direction: column; gap: 10px; margin-top: 4px; }
.app-badge {
    display: flex; align-items: center; gap: 10px;
    background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px; padding: 8px 14px; transition: all 0.2s; color: #fff;
}
.app-badge:hover { border-color: rgba(255,255,255,0.2); background: rgba(255,255,255,0.09); }
.app-badge i { font-size: 22px; }
.app-badge-text small { display: block; color: #6b7080; font-size: 10px; }
.app-badge-text strong { font-size: 13px; font-weight: 600; }

/* Divider */
.footer-divider { height: 1px; background: rgba(255,255,255,0.06); margin: 0; }

/* Bottom bar */
.footer-bottom {
    max-width: 1280px; margin: 0 auto; padding: 22px 24px;
    display: flex; align-items: center; justify-content: space-between; gap: 16px;
    flex-wrap: wrap;
}
.footer-bottom p { color: #4a5060; font-size: 13px; }
.footer-bottom p a { color: #6b7080; }
.footer-bottom p a:hover { color: #9397a8; }
.footer-bottom-links { display: flex; gap: 24px; }
.footer-bottom-links a { color: #4a5060; font-size: 13px; transition: color 0.2s; }
.footer-bottom-links a:hover { color: #9397a8; }

/* Payments */
.footer-payments { display: flex; align-items: center; gap: 10px; }
.payment-icon {
    height: 24px; padding: 3px 10px; background: rgba(255,255,255,0.08);
    border-radius: 5px; display: flex; align-items: center; justify-content: center;
    color: #9397a8; font-size: 18px;
}

@media (max-width: 1024px) {
    .footer-grid { grid-template-columns: 1fr 1fr 1fr; }
    .footer-brand { grid-column: span 3; }
}
@media (max-width: 768px) {
    .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
    .footer-brand { grid-column: span 2; }
    .footer-bottom { flex-direction: column; text-align: center; }
    .footer-bottom-links { justify-content: center; gap: 16px; }
}
@media (max-width: 480px) {
    .footer-grid { grid-template-columns: 1fr; }
    .footer-brand { grid-column: span 1; }
}
</style>

<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-grid">

            <!-- Brand -->
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="footer-logo">
                    <div class="footer-logo-icon"><i class="fa-solid fa-bolt-lightning"></i></div>
                    Pixel<span>Vault</span>
                </a>
                <p class="footer-desc">
                    The world's leading marketplace for premium digital assets —
                    photos, videos, audio, and more. Empowering creators, inspiring the world.
                </p>
                <div class="footer-newsletter">
                    <input type="email" placeholder="Your email address…" id="footerEmail">
                    <button><i class="fa-solid fa-paper-plane" style="margin-right:6px;"></i> Subscribe</button>
                </div>
                <div class="footer-socials">
                    <a href="#" class="footer-social"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="footer-social"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="footer-social"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="footer-social"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" class="footer-social"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="footer-social"><i class="fa-brands fa-pinterest-p"></i></a>
                </div>
            </div>

            <!-- Marketplace -->
            <div class="footer-col">
                <h4>Marketplace</h4>
                <ul>
                    <li><a href="#">Photos</a></li>
                    <li><a href="#">Videos</a></li>
                    <li><a href="#">Audio & Music</a></li>
                    <li><a href="#">Vectors & Illustrations</a></li>
                    <li><a href="#">3D Assets <span class="badge-new">New</span></a></li>
                    <li><a href="#">Templates</a></li>
                    <li><a href="#">Fonts</a></li>
                    <li><a href="#">Free Assets <span class="badge-new">Free</span></a></li>
                </ul>
            </div>

            <!-- Creators -->
            <div class="footer-col">
                <h4>Creators</h4>
                <ul>
                    <li><a href="#">Start Selling</a></li>
                    <li><a href="#">Creator Dashboard</a></li>
                    <li><a href="#">Revenue & Payouts</a></li>
                    <li><a href="#">Referral Program</a></li>
                    <li><a href="#">Affiliate System</a></li>
                    <li><a href="#">Creator Blog</a></li>
                    <li><a href="#">Upload Guidelines</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Pricing Plans</a></li>
                    <li><a href="#">Licensing Options</a></li>
                    <li><a href="#">Enterprise</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Press Kit</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>

            <!-- Apps -->
            <div class="footer-col">
                <h4>Get the App</h4>
                <div class="footer-apps">
                    <a href="#" class="app-badge">
                        <i class="fa-brands fa-apple"></i>
                        <div class="app-badge-text">
                            <small>Download on the</small>
                            <strong>App Store</strong>
                        </div>
                    </a>
                    <a href="#" class="app-badge">
                        <i class="fa-brands fa-google-play"></i>
                        <div class="app-badge-text">
                            <small>Get it on</small>
                            <strong>Google Play</strong>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="footer-divider"></div>

    <div class="footer-bottom">
        <p>© 2026 PixelVault, Inc. All rights reserved.
            <a href="#">Privacy Policy</a> · <a href="#">Terms of Service</a>
        </p>
        <div class="footer-bottom-links">
            <a href="#">Cookie Settings</a>
            <a href="#">Sitemap</a>
            <a href="#">Accessibility</a>
        </div>
        <div class="footer-payments">
            <div class="payment-icon"><i class="fa-brands fa-cc-stripe"></i></div>
            <div class="payment-icon"><i class="fa-brands fa-cc-paypal"></i></div>
            <div class="payment-icon"><i class="fa-brands fa-cc-visa"></i></div>
            <div class="payment-icon"><i class="fa-brands fa-cc-mastercard"></i></div>
            <div class="payment-icon"><i class="fa-brands fa-cc-amex"></i></div>
        </div>
    </div>
</footer>
