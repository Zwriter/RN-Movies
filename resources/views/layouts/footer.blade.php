<footer class="pt-4 pb-3 mt-5" style="background-color: #1a1a2e; border-top: 2px solid #f5c518;">
    <div class="container">
        <div class="row">

            <div class="col-md-4 mb-3">
                <h5 class="fw-bold" style="color: #f5c518; letter-spacing: 1px;">
                    {{ config('app.name', 'RNM') }}
                </h5>
                <p class="text-white-50 small">Browse the latest movies, reviews, and details from our collection.</p>
            </div>

            <div class="col-md-4 mb-3">
                <h6 class="text-white-50 text-uppercase small mb-3" style="letter-spacing: 1px;">Explore</h6>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-white-50 text-decoration-none">Home</a></li>
                    <li><a href="/movies" class="text-white-50 text-decoration-none">Movies</a></li>
                    <li><a href="/genres" class="text-white-50 text-decoration-none">Genres</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-3">
                <h6 class="text-white-50 text-uppercase small mb-3" style="letter-spacing: 1px;">Contact</h6>
                <p class="text-white-50 small mb-1">test@gmail.com</p>
                <p class="text-white-50 small mb-0">+40 123 123 123</p>
            </div>

        </div>

        <div class="pt-3 mt-3 text-center small text-white-50" style="border-top: 1px solid #333;">
            © {{ date('Y') }} {{ config('app.name', 'RNM') }}. All rights reserved.
        </div>
    </div>
</footer>