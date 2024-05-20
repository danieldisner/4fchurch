document.addEventListener('DOMContentLoaded', function() {
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function() {
            const imgElement = document.getElementById('photo-preview');
            imgElement.src = reader.result;
            imgElement.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }

    function formatCPF(value) {
        return value
            .replace(/\D/g, '')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }

    function formatCep(value) {
        return value
            .replace(/\D/g, '')
            .replace(/(\d{5})(\d)/, '$1-$2')
            .replace(/(-\d{3})\d+?$/, '$1');
    }

    function formatRG(value){
        const v = value.toUpperCase().replace(/[^\dX]/g,'');
        return (v.length==8 || v.length==9)?
           v.replace(/^(\d{1,2})(\d{3})(\d{3})([\dX])$/,'$1.$2.$3-$4'):
           (value)
        ;
    }

    function formatPhone(value) {
        return value
            .replace(/\D/g, '')
            .replace(/(\d{2})(\d)/, '($1) $2')
            .replace(/(\d{4,5})(\d{4})/, '$1-$2');
    }

    function formatWhatsApp(value) {
        return value
            .replace(/\D/g, '')
            .replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    }

    async function fetchAddress() {
        const cep = document.getElementById('address_zipcode').value.replace(/\.|\-/g, '');
        if (cep.length >= 8) {
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            if (response.ok) {
                const data = await response.json();
                if (!data.erro) {
                    document.getElementById('address_street').value = data.logradouro;
                    document.getElementById('address_neighborhood').value = data.bairro;
                    document.getElementById('city').value = data.localidade;
                    document.getElementById('uf').value = data.uf;
                } else {
                    alert('CEP não encontrado.');
                }
            } else {
                alert('Erro ao buscar o CEP.');
            }
        }
    }

    // Adicionando eventos aos elementos
    const cpfInput = document.getElementById('cpf');
    const rgInput = document.getElementById('rg');
    const phoneInput = document.getElementById('phone');
    const whatsappInput = document.getElementById('whatsapp');
    const photoInput = document.getElementById('photo');
    const zipcodeInput = document.getElementById('address_zipcode');

    if (cpfInput) {
        cpfInput.addEventListener('input', function(e) {
            e.target.value = formatCPF(e.target.value);
        });
    }

    if (rgInput) {
        rgInput.addEventListener('input', function(e) {
            e.target.value = formatRG(e.target.value);
        });
    }

    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            e.target.value = formatPhone(e.target.value);
        });
    }

    if (whatsappInput) {
        whatsappInput.addEventListener('input', function(e) {
            e.target.value = formatWhatsApp(e.target.value);
        });
    }

    if (zipcodeInput) {
        zipcodeInput.addEventListener('blur', function(e){
            fetchAddress();
            e.target.value = formatCep(e.target.value);
        });
    }

    if (photoInput) {
        photoInput.addEventListener('change', previewImage);
    }
});
