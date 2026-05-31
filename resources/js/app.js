import './bootstrap';

let searchTimeout = null;

function hideSearchResults(searchResults) {
    if (searchResults) {
        searchResults.classList.add('d-none');
        searchResults.innerHTML = '';
    }
}

function renderSearchResults(searchResults, items) {
    if (!searchResults) {
        return;
    }

    if (items.length === 0) {
        searchResults.innerHTML = '<div class="list-group-item disabled">No movies found</div>';
        searchResults.classList.remove('d-none');
        return;
    }

    searchResults.innerHTML = items.map(item => `
        <a href="${item.url}" class="list-group-item list-group-item-action">
            ${item.title}
        </a>
    `).join('');
    searchResults.classList.remove('d-none');
}

window.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('movie-search-input');
    const searchResults = document.getElementById('movie-search-results');

    if (!searchInput || !searchResults) {
        return;
    }

    searchInput.addEventListener('input', (event) => {
        const query = event.target.value.trim();

        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        if (query.length < 1) {
            hideSearchResults(searchResults);
            return;
        }

        searchTimeout = setTimeout(async () => {
            try {
                const response = await fetch(`/movies/search?q=${encodeURIComponent(query)}`);
                const results = await response.json();

                if (Array.isArray(results)) {
                    renderSearchResults(searchResults, results);
                } else {
                    hideSearchResults(searchResults);
                }
            } catch (error) {
                hideSearchResults(searchResults);
            }
        }, 250);
    });

    document.addEventListener('click', (event) => {
        if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
            hideSearchResults(searchResults);
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            hideSearchResults(searchResults);
            searchInput.blur();
        }
    });
});
