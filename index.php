<div class="search-container">
    <input
        id="ajax-search"
        class="search__input"
        type="text"
        placeholder="Я ищу фейерверк 100 залпов"
        autocomplete="off">
    <div id="search-results" class="search-results"></div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('ajax-search');
        const resultsContainer = document.getElementById('search-results');
        searchInput.addEventListener('input', function () {
            const query = searchInput.value.trim();
            if (query.length < 3) {
                resultsContainer.innerHTML = ''; // Очистить результаты при коротком запросе
                return;
            }
            resultsContainer.innerHTML = '<p>Загрузка...</p>'; // Индикатор загрузки
            fetch(`${ajaxurl}?action=ajax_search&query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        resultsContainer.innerHTML = data.results.length
                            ? data.results.map(item => `<div><a href="${item.link}">${item.title}</a></div>`).join('')
                            : '<p>Ничего не найдено</p>';
                    } else {
                        resultsContainer.innerHTML = '<p>Ошибка выполнения поиска</p>';
                    }
                })
                .catch(() => {
                    resultsContainer.innerHTML = '<p>Ошибка соединения</p>';
                });
        });
        // Обработка нажатия клавиши Enter
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                const query = searchInput.value.trim();
                if (query.length >= 3) {
                    // Переход на страницу поиска
                    window.location.href = `/search?s=${encodeURIComponent(query)}`;
                }
            }
        });
    });


</script>
