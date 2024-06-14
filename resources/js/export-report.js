document.addEventListener('DOMContentLoaded', function() {
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

    const getDateParams = () => {
        const date = document.getElementById('date_transfer') ? document.getElementById('date_transfer').value : null;
        const startDate = document.getElementById('start_date') ? document.getElementById('start_date').value : null;
        const endDate = document.getElementById('end_date') ? document.getElementById('end_date').value : null;

        if (date) {
            return `date=${date}`;
        } else if (startDate && endDate) {
            return `start_date=${startDate}&end_date=${endDate}`;
        }
        return '';
    };

    document.getElementById('export-pdf').addEventListener('click', function() {
        const dateParams = getDateParams();
        window.location.href = `/finances/export-pdf?${dateParams}`;
    });

    document.getElementById('export-csv').addEventListener('click', function() {
        const dateParams = getDateParams();
        window.location.href = `/finances/export-csv?${dateParams}`;
    });

    document.getElementById('export-excel').addEventListener('click', function() {
        const dateParams = getDateParams();
        window.location.href = `/finances/export-excel?${dateParams}`;
    });

    document.getElementById('print-report').addEventListener('click', function() {
        const dateParams = getDateParams();
        window.location.href = `/finances/print?${dateParams}`;
    });
});
