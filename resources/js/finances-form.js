import { formatCurrency, formatDate } from './formatting.js';

document.addEventListener('DOMContentLoaded', function() {
    const fetchData = async () => {
        try {
            const date = document.getElementById('date_transfer').value;
            const response = await fetch(`/finances/data?date=${date}`);
            const data = await response.json();
            updateTables(data.entradas, data.saidas, data.permissions);
        } catch (error) {
            console.error('Error fetching data:', error);
            showMessage(error.message, 'error');
        }
    };

    const createEditButton = (permissions) => {
        return permissions.edit ? `<button class="edit-button">E</button>` : '';
    };

    const createRemoveButton = (permissions) => {
        return permissions.delete ? `<button class="remove-button">-</button>` : '';
    };

    const updateTables = (entradas, saidas, permissions) => {
        const entradasTableBody = document.querySelector('#entradas-table tbody');
        const saidasTableBody = document.querySelector('#saidas-table tbody');
        const totalEntradas = document.querySelector('#total-entradas');
        const totalSaidas = document.querySelector('#total-saidas');
        const saldoTotal = document.querySelector('#saldo-total');

        entradasTableBody.innerHTML = '';
        saidasTableBody.innerHTML = '';

        let entradasTotal = 0;
        let saidasTotal = 0;

        const renderRow = (data, transactionType, permissions) => {
            const value = parseFloat(data.value);
            const editButton = createEditButton(permissions);
            const removeButton = createRemoveButton(permissions);
            const inputReadOnly = permissions.edit ? '' : 'readonly';
            const inputDisabled = permissions.edit ? '' : 'disabled';

            return `
                <tr data-id="${data.id}" data-transaction-type="${transactionType}" class="hover:bg-gray-100">
                    <td class="hidden">${data.id}</td>
                    <td class="px-1 py-2 text-sm text-gray-900 table-cell">${removeButton}</td>
                    <td class="px-2 py-2 text-sm text-gray-900 table-cell transaction-title"><input type="text" value="${data.title}" class="editable table-input text-input" ${inputReadOnly} /></td>
                    <td class="px-2 py-2 text-sm text-gray-900 table-cell transaction-date">${formatDate(data.date_transfer)}</td>
                    <td class="px-2 py-2 text-sm text-gray-900 table-cell transaction-source">
                        <select class="editable table-input select-input" ${inputDisabled}>
                            <option value="Banco" ${data.source === 'Banco' ? 'selected' : ''}>Banco</option>
                            <option value="Caixa" ${data.source === 'Caixa' ? 'selected' : ''}>Caixa</option>
                        </select>
                    </td>
                    <td class="px-2 py-2 text-sm text-gray-900 table-cell transaction-value"><input type="text" value="${formatCurrency(value)}" class="editable table-input number-input" ${inputReadOnly} /></td>
                    <td class="hidden transaction-description">${data.description}</td>
                </tr>
            `;
        };

        entradas.forEach(entrada => {
            entradasTableBody.insertAdjacentHTML('beforeend', renderRow(entrada, 'Entrada', permissions));
            entradasTotal += parseFloat(entrada.value);
        });

        saidas.forEach(saida => {
            saidasTableBody.insertAdjacentHTML('beforeend', renderRow(saida, 'Saída', permissions));
            saidasTotal += parseFloat(saida.value);
        });

        totalEntradas.textContent = formatCurrency(entradasTotal);
        totalSaidas.textContent = formatCurrency(saidasTotal);
        saldoTotal.textContent = formatCurrency(entradasTotal - saidasTotal);
    };

    const extractRowData = (row) => {
        return {
            id: row.dataset.id,
            transaction_type: row.dataset.transactionType,
            title: row.querySelector('.transaction-title input')?.value || '',
            date_transfer: row.querySelector('.transaction-date')?.textContent.split('/').reverse().join('-') || '',
            source: row.querySelector('.transaction-source select')?.value || '',
            value: row.querySelector('.transaction-value input')?.value.replace('.', '').replace(',', '.') || '',
            description: row.querySelector('.transaction-description')?.textContent || ''
        };
    };

    fetchData();

    const financeForm = document.getElementById('finance-form');
    if (financeForm) {
        financeForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const transactionType = document.getElementById('transaction_type').value;
            const title = document.getElementById('title').value;
            const source = document.getElementById('source').value;
            const dateTransfer = document.getElementById('date_transfer').value;
            const value = parseFloat(document.getElementById('value').value.replace(',', '.')).toFixed(2);
            const description = document.getElementById('description').value;

            if (isNaN(value)) {
                showMessage('Por favor, insira um valor válido.', 'error');
                return;
            }

            const formData = {
                transaction_type: transactionType,
                title: title,
                source: source,
                date_transfer: dateTransfer,
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
                showMessage('Dados enviados com sucesso', 'success');
            } catch (error) {
                console.error('Erro ao enviar os dados:', error);
                showMessage(error.message, 'error');
            }
        });
    }

    document.getElementById('date_transfer').addEventListener('change', fetchData);

    document.querySelectorAll('#entradas-table tbody, #saidas-table tbody').forEach(tbody => {
        tbody.addEventListener('change', async event => {
            const cell = event.target.closest('input, select');
            if (!cell) return;

            const row = cell.closest('tr');
            if (!row) {
                console.error('Row not found for cell:', cell);
                showMessage('Linha não encontrada para a célula.', 'error');
                return;
            }

            const rowData = extractRowData(row);
            if (!rowData.id) {
                console.error('Row ID not found:', rowData);
                showMessage('ID da linha não encontrado.', 'error');
                return;
            }

            try {
                const response = await fetch(`/finances/${rowData.id}/update`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(rowData)
                });

                if (!response.ok) {
                    throw new Error('Erro ao enviar os dados');
                }

                fetchData();
                showMessage('Dados atualizados com sucesso', 'success');
            } catch (error) {
                console.error('Erro ao enviar os dados:', error);
                showMessage(error.message, 'error');
            }
        });
    });

    document.querySelectorAll('#entradas-table tbody, #saidas-table tbody').forEach(tbody => {
        tbody.addEventListener('click', async event => {
            if (event.target.matches('.remove-button')) {
                const row = event.target.closest('tr');
                const rowId = row.dataset.id;

                try {
                    const response = await fetch(`/finances/${rowId}/delete`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Erro ao remover o dado');
                    }

                    row.remove();
                    fetchData();
                    showMessage('Dado removido com sucesso', 'success');
                } catch (error) {
                    console.error('Erro ao remover o dado:', error);
                    showMessage(error.message, 'error');
                }
            }
        });
    });

    const exportButton = document.getElementById('export-button');
    const reportOptions = document.getElementById('report-options');

    const showReportOptions = () => {
        reportOptions.style.display = 'flex';
    };

    const hideReportOptions = () => {
        reportOptions.style.display = 'none';
    };

    exportButton.addEventListener('mouseenter', showReportOptions);

    exportButton.addEventListener('mouseleave', () => {
        setTimeout(hideReportOptions, 3000);
    });

    document.getElementById('export-pdf').addEventListener('click', function() {
        const date = document.getElementById('date_transfer').value;
        window.location.href = `/finances/export-pdf?date=${date}`;
    });

    document.getElementById('export-csv').addEventListener('click', function() {
        const date = document.getElementById('date_transfer').value;
        window.location.href = `/finances/export-csv?date=${date}`;
    });

    document.getElementById('export-excel').addEventListener('click', function() {
        const date = document.getElementById('date_transfer').value;
        window.location.href = `/finances/export-excel?date=${date}`;
    });

    document.getElementById('print-report').addEventListener('click', function() {
        const date = document.getElementById('date_transfer').value;
        window.location.href = `/finances/print?date=${date}`;
    });
});
