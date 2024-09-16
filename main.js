document.addEventListener('DOMContentLoaded', () => {
    const numbersContainer = document.getElementById('numbers-container');
    const selectedNumbersInput = document.getElementById('selected-numbers');
    const buttons = numbersContainer.querySelectorAll('.number');
    const form = document.getElementById('game-form');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const number = button.getAttribute('data-number');
            if (button.classList.contains('selected')) {
                button.classList.remove('selected');
                const numbers = selectedNumbersInput.value.split(',').filter(n => n && n != number);
                selectedNumbersInput.value = numbers.join(',');
            } else if (selectedNumbersInput.value.split(',').length < 25) {
                button.classList.add('selected');
                selectedNumbersInput.value += (selectedNumbersInput.value ? ',' : '') + number;
            }
        });
    });

    form.addEventListener('submit', (event) => {
        const selectedNumbers = selectedNumbersInput.value.split(',').filter(n => n);
        if (selectedNumbers.length !== 25) {
            event.preventDefault(); // impede o envio caso esteja errado
            alert('Você deve selecionar exatamente 25 números. Por favor, ajuste sua seleção.');
        }
    });
});
