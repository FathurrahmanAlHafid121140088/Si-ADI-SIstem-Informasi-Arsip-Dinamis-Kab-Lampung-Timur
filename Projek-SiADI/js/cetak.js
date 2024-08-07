function printTable() {
  const table = document.querySelector("table");
  const headers = Array.from(table.querySelectorAll("th"));
  const rows = Array.from(table.querySelectorAll("tr")).slice(1); // Get all rows excluding the header

  const colGroups = [
    headers.slice(0, 8), // First 8 columns
    headers.slice(8), // Remaining columns
  ];

  const rowGroups = rows.map((row) => {
    const cells = Array.from(row.querySelectorAll("td"));
    return [
      cells.slice(0, 8), // First 8 columns
      cells.slice(8), // Remaining columns
    ];
  });

  const printWindow = window.open("", "", "height=1000,width=1000");
  printWindow.document.write("<html><head><title>Print Table</title>");

  // Tambahkan gaya CSS untuk mencetak
  printWindow.document.write("<style>");
  printWindow.document.write(
    "table { width: 100%; border-collapse: collapse; }"
  );
  printWindow.document.write("table, th, td { border: 1px solid black; }");
  printWindow.document.write("th, td { padding: 8px; text-align: center; }"); // Updated line
  printWindow.document.write("th { background-color: #3b6eb2; color: #000; }"); // Updated line
  printWindow.document.write(
    "tr:nth-child(even) { background-color: #f2f2f2; }"
  );
  printWindow.document.write("tr:hover { background-color: #ddd; }");
  printWindow.document.write("</style>");

  printWindow.document.write("</head><body>");

  // Tambahkan header h2 disini
  printWindow.document.write("<h2 class='h2'>Data Arsip Musnah</h2>");

  colGroups.forEach((colGroup, index) => {
    printWindow.document.write("<table>");
    printWindow.document.write("<thead><tr>");
    colGroup.forEach((col) => printWindow.document.write(col.outerHTML));
    printWindow.document.write("</tr></thead>");
    printWindow.document.write("<tbody>");
    rowGroups.forEach((rowGroup) => {
      printWindow.document.write("<tr>");
      rowGroup[index].forEach((cell) =>
        printWindow.document.write(cell.outerHTML)
      );
      printWindow.document.write("</tr>");
    });
    printWindow.document.write("</tbody></table>");
    if (index === 0) {
      printWindow.document.write("<hr>"); // Separator between the two tables
    }
  });

  printWindow.document.write("</body></html>");
  printWindow.document.close();
  printWindow.focus();
  printWindow.print();
}
