<script>
    function printData() {
        let headerTable = `
            <tr>
                <th>No</th>
                <?php if (isset($columnNames)) : ?>
                    <?php foreach ($columnNames as $columnName) : ?>
                        <th><?= ucwords(str_replace("_", " ", esc($columnName))); ?></th>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tr>
        `;

        let contentTable = `
            <?php $no = 1; ?>
            <?php if (isset($records)) : ?>
                <?php foreach ($records as $record) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <?php foreach ($columnNames as $columnName) : ?>
                            <td><?= esc($record[$columnName]); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        `;

        const iframe = document.getElementById('printFrame').contentWindow;
        iframe.document.open();
        iframe.document.write(`
        
            <html>
                <head>
                    <title>App Bimbingan Konseling</title>
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

                        @media print {
                            body {
                                font-family: "Nunito", sans-serif;
                            }
                            .container, table {
                                width: 100%;
                            }
                            table {
                                border-collapse: collapse;
                                margin-top: 1rem;
                            }
                            h1 {
                                margin-top: 1.5rem;
                            }
                            table th,
                            table td {
                                border: 1px solid #000;
                                padding: 8px 15px;
                                color: #000;
                                text-align: center;
                            }
                            table th {
                                padding: 15px !important;
                                font-size: 1.2rem;
                            }
                        }
                    </style>
                </head>
                <body>
                    <h1>Data <?= ucwords($title) ?? 'Cetak'; ?></h1>
                    <table>
                        <thead>${headerTable}</thead>
                        <tbody>${contentTable}</tbody>
                    </table>
                </body>
            </html>
    
        `);
        iframe.document.close();
        iframe.focus();
        iframe.print();
    }
</script>