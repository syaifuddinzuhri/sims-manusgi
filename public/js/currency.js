document.addEventListener('DOMContentLoaded', () => {
    $('.currency-mask').toArray().forEach(function(field) {
        new Cleave(field, {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.'
        });
    });
});
