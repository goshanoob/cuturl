// Скрипт копирования ссылок в личном кабинете.

document.addEventListener('DOMContentLoaded', () => {
    const copyButton = document.querySelectorAll('.copy-btn');
    for (let button of copyButton) {
        button.addEventListener('click', copyLink);
    }

    // Получить и копировать ссылку.
    function copyLink(e) {
        const link = e.currentTarget.getAttribute('data-clipboard-text');
        getCopy(link);
        const prompt = document.querySelector('.toast');
        prompt.querySelector('.toast-body').textContent = `Ссылка '${link}' скопирована в буфер`;
        prompt.classList.toggle('show');
        setTimeout(() => prompt.classList.toggle('show'), 2000);
    }

    // Копировать ссылку в буфер обмена.
    function getCopy(link) {
        const input = document.createElement('input');
        document.body.appendChild(input);
        input.value = link;
        input.select();
        document.execCommand("copy");
        input.remove();
    }
});

