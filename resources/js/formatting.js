export function formatCurrency(value) {
    return parseFloat(value).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

export function formatDate(date) {
    const [year, month, day] = date.split('-');
    return `${day}/${month}/${year}`;
}

export function formatCPF(value) {
    return value
        .replace(/\D/g, '')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
}

export function formatCep(value) {
    return value
        .replace(/\D/g, '')
        .replace(/(\d{5})(\d)/, '$1-$2')
        .replace(/(-\d{3})\d+?$/, '$1');
}

export function formatRG(value) {
    const v = value.toUpperCase().replace(/[^\dX]/g, '');
    return (v.length == 8 || v.length == 9) ?
        v.replace(/^(\d{1,2})(\d{3})(\d{3})([\dX])$/, '$1.$2.$3-$4') :
        value;
}

export function formatPhone(value) {
    return value
        .replace(/\D/g, '')
        .replace(/(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{4,5})(\d{4})/, '$1-$2');
}

export function formatWhatsApp(value) {
    return value
        .replace(/\D/g, '')
        .replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
}
