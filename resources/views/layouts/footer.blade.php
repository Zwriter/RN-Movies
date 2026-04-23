<footer class="bg-dark text-white pt-4 pb-3 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5>{{ config('app.name', 'RNM') }}</h5>
                <p class="text-muted">Browse the latest movies, reviews, and details from our collection.</p>
            </div>

            <div class="col-md-4 mb-3">
                <h6>Explore</h6>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="/movies" class="text-white text-decoration-none">Movies</a></li>
                    <li><a href="/about" class="text-white text-decoration-none">About</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-3">
                <h6>Contact</h6>
                <p class="text-muted mb-1">support@example.com</p>
                <p class="text-muted mb-0">+1 (555) 123-4567</p>
            </div>
        </div>

        <div class="border-top border-secondary pt-3 mt-3 text-center text-muted small">
            © {{ date('Y') }} {{ config('app.name', 'RNM') }}. All rights reserved.
        </div>
    </div>
</footer>