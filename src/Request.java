import java.awt.event.ActionEvent;
import java.awt.event.MouseEvent;
import java.io.*;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.List;
import javax.swing.*;
import javax.swing.table.DefaultTableModel;

public class Request extends javax.swing.JFrame {

    public Request() {
        initComponents();
        loadRequest();
        setLocationRelativeTo(null); // Center the window
    }

    private void initComponents() {

        jLabel1 = new javax.swing.JLabel();
        jScrollPane1 = new javax.swing.JScrollPane();
        jTable1 = new javax.swing.JTable();
        jRejectbtn = new javax.swing.JButton();
        jAcceptbtn = new javax.swing.JButton();
        jButtonBack = new javax.swing.JButton();
        tfID = new javax.swing.JTextField();
        tfName = new javax.swing.JTextField();
        tfReason = new javax.swing.JTextField();
        jLabel2 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        jLabel4 = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        jLabel1.setFont(new java.awt.Font("Segoe UI", 0, 30));
        jLabel1.setForeground(new java.awt.Color(0, 0, 102));
        jLabel1.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel1.setText("Reschedule Request");

        jTable1.setModel(new javax.swing.table.DefaultTableModel(
                new Object[][] {},
                new String[] { "ID", "Name", "Reason" }));
        jTable1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jTable1MouseClicked(evt);
            }
        });
        jScrollPane1.setViewportView(jTable1);

        jRejectbtn.setText("Reject");
        jRejectbtn.addActionListener(evt -> jRejectbtnActionPerformed(evt));

        jAcceptbtn.setText("Accept");
        jAcceptbtn.addActionListener(evt -> jAcceptbtnActionPerformed(evt));

        jButtonBack.setText("Back");
        jButtonBack.addActionListener(evt -> jButtonBackActionPerformed(evt));

        jLabel2.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel2.setText("ID");

        jLabel3.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel3.setText("Name");

        jLabel4.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel4.setText("Reason");

        // Layout setup
        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
                layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                        .addGroup(layout.createSequentialGroup()
                                .addGap(30)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                        .addComponent(jLabel2, javax.swing.GroupLayout.PREFERRED_SIZE, 80,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addComponent(tfID, javax.swing.GroupLayout.PREFERRED_SIZE, 150,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addComponent(jLabel3, javax.swing.GroupLayout.PREFERRED_SIZE, 80,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addComponent(tfName, javax.swing.GroupLayout.PREFERRED_SIZE, 150,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addComponent(jLabel4, javax.swing.GroupLayout.PREFERRED_SIZE, 80,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addComponent(tfReason, javax.swing.GroupLayout.PREFERRED_SIZE, 150,
                                                javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGap(30)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 400,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGroup(layout.createSequentialGroup()
                                                .addComponent(jAcceptbtn, javax.swing.GroupLayout.PREFERRED_SIZE, 100,
                                                        javax.swing.GroupLayout.PREFERRED_SIZE)
                                                .addGap(20)
                                                .addComponent(jRejectbtn, javax.swing.GroupLayout.PREFERRED_SIZE, 100,
                                                        javax.swing.GroupLayout.PREFERRED_SIZE)
                                                .addGap(20)
                                                .addComponent(jButtonBack, javax.swing.GroupLayout.PREFERRED_SIZE, 100,
                                                        javax.swing.GroupLayout.PREFERRED_SIZE)))
                                .addGap(30))
                        .addGroup(layout.createSequentialGroup()
                                .addGap(220)
                                .addComponent(jLabel1)
                                .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)));

        layout.setVerticalGroup(
                layout.createSequentialGroup()
                        .addGap(20)
                        .addComponent(jLabel1)
                        .addGap(20)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 200,
                                        javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGroup(layout.createSequentialGroup()
                                        .addComponent(jLabel2)
                                        .addGap(5)
                                        .addComponent(tfID, javax.swing.GroupLayout.PREFERRED_SIZE, 30,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(10)
                                        .addComponent(jLabel3)
                                        .addGap(5)
                                        .addComponent(tfName, javax.swing.GroupLayout.PREFERRED_SIZE, 30,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(10)
                                        .addComponent(jLabel4)
                                        .addGap(5)
                                        .addComponent(tfReason, javax.swing.GroupLayout.PREFERRED_SIZE, 30,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)))
                        .addGap(20)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                                .addComponent(jAcceptbtn, javax.swing.GroupLayout.PREFERRED_SIZE, 40,
                                        javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addComponent(jRejectbtn, javax.swing.GroupLayout.PREFERRED_SIZE, 40,
                                        javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addComponent(jButtonBack, javax.swing.GroupLayout.PREFERRED_SIZE, 40,
                                        javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(30));

        pack();
    }

    // Method to load requests from "request.txt" and populate the table
    private void loadRequest() {
        DefaultTableModel model = (DefaultTableModel) jTable1.getModel();
        model.setRowCount(0); // Clear existing rows

        String filePath = "request.txt";

        // Create the file if it doesn't exist
        File file = new File(filePath);
        try {
            if (!file.exists()) {
                file.createNewFile();
            }
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error creating the file: " + e.getMessage(), "Error",
                    JOptionPane.ERROR_MESSAGE);
            return;
        }

        // Read the file and populate the table
        try (BufferedReader reader = new BufferedReader(new FileReader(filePath))) {
            String line;
            while ((line = reader.readLine()) != null) {
                String[] parts = line.split(",");
                if (parts.length == 3) {
                    model.addRow(new Object[] { parts[0], parts[1], parts[2] });
                }
            }
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error reading requests: " + e.getMessage(), "Error",
                    JOptionPane.ERROR_MESSAGE);
        }
    }

    // Method to handle accepting a request
    private void jAcceptbtnActionPerformed(ActionEvent evt) {
        DefaultTableModel model = (DefaultTableModel) jTable1.getModel();
        int selectedRowIndex = jTable1.getSelectedRow();

        if (selectedRowIndex == -1) {
            JOptionPane.showMessageDialog(this, "Please select a request to accept!", "Error",
                    JOptionPane.ERROR_MESSAGE);
            return;
        }

        String id = model.getValueAt(selectedRowIndex, 0).toString();
        String name = model.getValueAt(selectedRowIndex, 1).toString();
        String reason = model.getValueAt(selectedRowIndex, 2).toString();
        String removeRequest = id + "," + name + "," + reason;

        updateRequestFile(removeRequest);
        saveToFile("accept.txt", id, name, reason);
        model.removeRow(selectedRowIndex);

        JOptionPane.showMessageDialog(this, "Request accepted successfully!");
        clearFields();
    }

    // Method to handle rejecting a request
    private void jRejectbtnActionPerformed(ActionEvent evt) {
        DefaultTableModel model = (DefaultTableModel) jTable1.getModel();
        int selectedRowIndex = jTable1.getSelectedRow();

        if (selectedRowIndex == -1) {
            JOptionPane.showMessageDialog(this, "Please select a request to reject!", "Error",
                    JOptionPane.ERROR_MESSAGE);
            return;
        }

        String id = model.getValueAt(selectedRowIndex, 0).toString();
        String name = model.getValueAt(selectedRowIndex, 1).toString();
        String reason = model.getValueAt(selectedRowIndex, 2).toString();
        String removeRequest = id + "," + name + "," + reason;

        updateRequestFile(removeRequest);
        saveToFile("reject.txt", id, name, reason);
        model.removeRow(selectedRowIndex);

        JOptionPane.showMessageDialog(this, "Request rejected successfully!");
        clearFields();
    }

    // Method to handle table row clicks and populate the text fields
    protected void jTable1MouseClicked(MouseEvent evt) {
        DefaultTableModel model = (DefaultTableModel) jTable1.getModel();
        int selectedRowIndex = jTable1.getSelectedRow();

        tfID.setText(model.getValueAt(selectedRowIndex, 0).toString());
        tfName.setText(model.getValueAt(selectedRowIndex, 1).toString());
        tfReason.setText(model.getValueAt(selectedRowIndex, 2).toString());
    }

    // Helper method to remove a request from "request.txt"
    private void updateRequestFile(String requestToRemove) {
        String filePath = "request.txt";
        List<String> updatedLines = new ArrayList<>();

        try {
            List<String> lines = Files.readAllLines(Paths.get(filePath));
            for (String line : lines) {
                if (!line.equals(requestToRemove)) {
                    updatedLines.add(line);
                }
            }
            Files.write(Paths.get(filePath), updatedLines);
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error updating requests: " + e.getMessage(), "Error",
                    JOptionPane.ERROR_MESSAGE);
        }
    }

    // Helper method to save to "accept.txt" or "reject.txt"
    private void saveToFile(String fileName, String id, String name, String reason) {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(fileName, true))) {
            writer.write(id + "," + name + "," + reason);
            writer.newLine();
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error saving to file: " + e.getMessage(), "Error",
                    JOptionPane.ERROR_MESSAGE);
        }
    }

    // Helper method to clear text fields
    private void clearFields() {
        tfID.setText("");
        tfName.setText("");
        tfReason.setText("");
    }

    private void jButtonBackActionPerformed(java.awt.event.ActionEvent evt) {
        new DashMenu().setVisible(true); // Open the Dashboard
        dispose(); // Close the current Request window
    }

    // Existing methods (loadRequest, jAcceptbtnActionPerformed,
    // jRejectbtnActionPerformed, jTable1MouseClicked) remain unchanged

    public static void main(String args[]) {
        java.awt.EventQueue.invokeLater(() -> new Request().setVisible(true));
    }

    // Variables declaration
    private javax.swing.JButton jAcceptbtn;
    private javax.swing.JButton jRejectbtn;
    private javax.swing.JButton jButtonBack;
    private javax.swing.JLabel jLabel1, jLabel2, jLabel3, jLabel4;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTable jTable1;
    private javax.swing.JTextField tfID, tfName, tfReason;
}
