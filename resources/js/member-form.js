import { formatCPF, formatCep, formatRG, formatPhone, formatWhatsApp } from './formatting.js';

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
