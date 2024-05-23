document.addEventListener('DOMContentLoaded', function() {
    const fetchData = async () => {
        try {
            const date = document.getElementById('date_transfer').value;
            const response = await fetch(`/finances/data?date=${date}`);
            const data = await response.json();
            updateTables(data.entradas, data.saidas);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    const updateTables = (entradas, saidas) => {
        const entradasTableBody = document.querySelector('#entradas-table tbody');
        const saidasTableBody = document.querySelector('#saidas-table tbody');
        const totalEntradas = document.querySelector('#total-entradas');
        const totalSaidas = document.querySelector('#total-saidas');
        const saldoTotal = document.querySelector('#saldo-total');

        const formatDate = (date) => {
            const [year, month, day] = date.split('-');
            return `${day}/${month}/${year}`;
        };

        entradasTableBody.innerHTML = '';
        saidasTableBody.innerHTML = '';

        let entradasTotal = 0;
        let saidasTotal = 0;

        entradas.forEach(entrada => {
            const value = parseFloat(entrada.value);
            entradasTableBody.insertAdjacentHTML('beforeend', `
                <tr data-id="${entrada.id}" data-transaction-type="Entrada" class="hover:bg-gray-100">
                    <td class="hidden">${entrada.id}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 table-cell table-cell-title"><input type="text" value="${entrada.title}" class="editable table-input text-input" /></td>
                    <td class="px-4 py-2 text-sm text-gray-900 table-cell">${formatDate(entrada.date_transfer)}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 table-cell">
                        <select class="editable table-input select-input">
                            <option value="Banco" ${entrada.source === 'Banco' ? 'selected' : ''}>Banco</option>
                            <option value="Caixa" ${entrada.source === 'Caixa' ? 'selected' : ''}>Caixa</option>
                        </select>
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-900 table-cell"><input type="number" value="${value.toFixed(2)}" class="editable table-input number-input" step="0.01" /></td>
                    <td class="hidden">${entrada.description}</td>
                </tr>
            `);
            entradasTotal += value;
        });

        saidas.forEach(saida => {
            const value = parseFloat(saida.value);
            saidasTableBody.insertAdjacentHTML('beforeend', `
                <tr data-id="${saida.id}" data-transaction-type="Saída" class="hover:bg-gray-100">
                    <td class="hidden">${saida.id}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 table-cell table-cell-title"><input type="text" value="${saida.title}" class="editable table-input text-input" /></td>
                    <td class="px-4 py-2 text-sm text-gray-900 table-cell">${formatDate(saida.date_transfer)}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 table-cell">
                        <select class="editable table-input select-input">
                            <option value="Banco" ${saida.source === 'Banco' ? 'selected' : ''}>Banco</option>
                            <option value="Caixa" ${saida.source === 'Caixa' ? 'selected' : ''}>Caixa</option>
                        </select>
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-900 table-cell"><input type="number" value="${value.toFixed(2)}" class="editable table-input number-input" step="0.01" /></td>
                    <td class="hidden">${saida.description}</td>
                </tr>
            `);
            saidasTotal += value;
        });

        totalEntradas.textContent = entradasTotal.toFixed(2);
        totalSaidas.textContent = saidasTotal.toFixed(2);
        saldoTotal.textContent = (entradasTotal - saidasTotal).toFixed(2);
    };

    fetchData();

    const financeForm = document.getElementById('finance-form');

    financeForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const transactionType = document.getElementById('transaction_type').value;
        const title = document.getElementById('title').value;
        const source = document.getElementById('source').value;
        const dateTransfer = document.getElementById('date_transfer').value;
        const value = parseFloat(document.getElementById('value').value.replace(',', '.')).toFixed(2);
        const description = document.getElementById('description').value;
        const dateTransferISO = new Date(dateTransfer).toISOString().split('T')[0];
        console.log(dateTransferISO);
        if (isNaN(value)) {
            alert('Por favor, insira um valor válido.');
            return;
        }

        const formData = {
            transaction_type: transactionType,
            title: title,
            source: source,
            date_transfer: dateTransferISO,
            value: value,
            description: description

        };

        try {
            const response = await fetch('/finances/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            });

            if (!response.ok) {
                throw new Error('Erro ao enviar os dados');
            }
            financeForm.reset();
            document.getElementById('date_transfer').value = dateTransfer;
            fetchData();
        } catch (error) {
            console.error('Erro ao enviar os dados:', error);
        }
    });

    document.getElementById('date_transfer').addEventListener('change', fetchData);

    document.querySelectorAll('#entradas-table tbody, #saidas-table tbody').forEach(tbody => {
        tbody.addEventListener('change', async event => {
            const cell = event.target.closest('input, select');
            if (!cell) return;

            const row = cell.closest('tr');
            const rowId = row.dataset.id;
            const transactionType = row.dataset.transactionType;
            const title = row.querySelector('td:nth-child(2) input').value;
            const dateTransfer = row.querySelector('td:nth-child(3)').textContent;
            const source = row.querySelector('td:nth-child(4) select').value;
            const value = row.querySelector('td:nth-child(5) input').value;
            const description = row.querySelector('td:nth-child(6)').value;

            const formData = {
                id: rowId,
                transaction_type: transactionType,
                title: title,
                source: source,
                date_transfer: dateTransfer,
                value: value,
                description: description
            };

            try {
                const response = await fetch(`/finances/${rowId}/update`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                });

                if (!response.ok) {
                    throw new Error('Erro ao enviar os dados');
                }
                fetchData();
                console.log('Dados enviados com sucesso');
            } catch (error) {
                console.error('Erro ao enviar os dados:', error);
            }
        });
    });


});
