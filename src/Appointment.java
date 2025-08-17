import java.io.*;
import javax.swing.*;
import javax.swing.table.DefaultTableModel;

public class Appointment extends javax.swing.JFrame {

    // Constructor
    public Appointment() {
        initComponents();
        loadAppointments();
        loadPreviousAppointments();
        setLocationRelativeTo(null);
    }

    private void loadAppointments() {
        DefaultTableModel model = (DefaultTableModel) jTable1.getModel();
        model.setRowCount(0); // Clear existing rows

        try (BufferedReader reader = new BufferedReader(new FileReader("appointment.txt"))) {
            String line;
            while ((line = reader.readLine()) != null) {
                String[] parts = line.split(",");
                if (parts.length == 3) {
                    model.addRow(new Object[] { parts[0], parts[1], parts[2] });
                }
            }
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error reading appointments: " + e.getMessage(), "Error",
                    JOptionPane.ERROR_MESSAGE);
        }
    }

    private void loadPreviousAppointments() {
        DefaultTableModel model = (DefaultTableModel) jTable2.getModel();
        model.setRowCount(0); // Clear existing rows

        try (BufferedReader reader = new BufferedReader(new FileReader("history.txt"))) {
            String line;
            while ((line = reader.readLine()) != null) {
                String[] parts = line.split(",");
                if (parts.length == 4) {
                    model.addRow(new Object[] { parts[0], parts[1], parts[2], parts[3] });
                }
            }
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error reading previous appointments: " + e.getMessage(), "Error",
                    JOptionPane.ERROR_MESSAGE);
        }
    }

    // Initialize GUI components
    private void initComponents() {

        jScrollPane1 = new javax.swing.JScrollPane();
        jTable1 = new javax.swing.JTable();
        jLabel1 = new javax.swing.JLabel();
        jScrollPane2 = new javax.swing.JScrollPane();
        jTable2 = new javax.swing.JTable();
        jLabel2 = new javax.swing.JLabel();
        jButtonFinish = new javax.swing.JButton();
        jLabel3 = new javax.swing.JLabel();
        tfName = new javax.swing.JTextField();
        jLabel4 = new javax.swing.JLabel();
        tfDate = new javax.swing.JTextField();
        jLabel5 = new javax.swing.JLabel();
        jcbTime = new javax.swing.JComboBox<>();
        jLabel6 = new javax.swing.JLabel();
        jcbStatus = new javax.swing.JComboBox<>();
        jButtonEdit = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        jTable1.setModel(new javax.swing.table.DefaultTableModel(
                new Object[][] {},
                new String[] { "Name", "Date", "Time" }));
        jTable1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jTable1MouseClicked(evt);
            }
        });
        jScrollPane1.setViewportView(jTable1);

        jLabel1.setFont(new java.awt.Font("Segoe UI", 0, 25));
        jLabel1.setText("Upcoming Appointment");

        jTable2.setModel(new javax.swing.table.DefaultTableModel(
                new Object[][] {},
                new String[] { "Name", "Date", "Time", "Status" }));
        jScrollPane2.setViewportView(jTable2);

        jLabel2.setFont(new java.awt.Font("Segoe UI", 0, 25));
        jLabel2.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel2.setText("Previous Appointment");

        jButtonFinish.setText("Finish");
        jButtonFinish.addActionListener(evt -> jButtonFinishActionPerformed());

        jLabel3.setText("Name");

        jLabel4.setText("Date");

        jLabel5.setText("Time");

        jcbTime.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] {
                "09:00 AM", "10:00 AM", "11:00 AM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM"
        }));

        jLabel6.setText("Status");

        jcbStatus.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "Completed", "Cancelled" }));

        jButtonEdit.setText("Back");
        jButtonEdit.addActionListener(evt -> {
            new DashMenu().setVisible(true); // Open the Dashboard
            dispose(); // Close the current Appointment window
        });

        // Layout setup
        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
                layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                        .addGroup(layout.createSequentialGroup()
                                .addGap(30)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                        .addComponent(jLabel1)
                                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 300,
                                                javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGap(20)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                                        .addComponent(jLabel3)
                                        .addComponent(tfName)
                                        .addComponent(jLabel4)
                                        .addComponent(tfDate)
                                        .addComponent(jLabel5)
                                        .addComponent(jcbTime, 0, 150, Short.MAX_VALUE)
                                        .addComponent(jLabel6)
                                        .addComponent(jcbStatus, 0, 150, Short.MAX_VALUE)
                                        .addGroup(layout.createSequentialGroup()
                                                .addComponent(jButtonEdit, javax.swing.GroupLayout.PREFERRED_SIZE, 80,
                                                        javax.swing.GroupLayout.PREFERRED_SIZE)
                                                .addGap(18)
                                                .addComponent(jButtonFinish, javax.swing.GroupLayout.PREFERRED_SIZE, 80,
                                                        javax.swing.GroupLayout.PREFERRED_SIZE)))
                                .addGap(20)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                        .addComponent(jLabel2)
                                        .addComponent(jScrollPane2, javax.swing.GroupLayout.PREFERRED_SIZE, 300,
                                                javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGap(30)));

        layout.setVerticalGroup(
                layout.createSequentialGroup()
                        .addGap(20)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                                .addComponent(jLabel1)
                                .addComponent(jLabel2))
                        .addGap(10)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 300,
                                        javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGroup(layout.createSequentialGroup()
                                        .addComponent(jLabel3)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(tfName, javax.swing.GroupLayout.PREFERRED_SIZE,
                                                javax.swing.GroupLayout.DEFAULT_SIZE,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(15)
                                        .addComponent(jLabel4)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(tfDate, javax.swing.GroupLayout.PREFERRED_SIZE,
                                                javax.swing.GroupLayout.DEFAULT_SIZE,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(15)
                                        .addComponent(jLabel5)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(jcbTime, javax.swing.GroupLayout.PREFERRED_SIZE,
                                                javax.swing.GroupLayout.DEFAULT_SIZE,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(15)
                                        .addComponent(jLabel6)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                        .addComponent(jcbStatus, javax.swing.GroupLayout.PREFERRED_SIZE,
                                                javax.swing.GroupLayout.DEFAULT_SIZE,
                                                javax.swing.GroupLayout.PREFERRED_SIZE)
                                        .addGap(30)
                                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                                                .addComponent(jButtonEdit)
                                                .addComponent(jButtonFinish)))
                                .addComponent(jScrollPane2, javax.swing.GroupLayout.PREFERRED_SIZE, 300,
                                        javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(20));

        pack();
    }

    // Event to handle table row click
    private void jTable1MouseClicked(java.awt.event.MouseEvent evt) {
        int selectedRowIndex = jTable1.getSelectedRow();
        if (selectedRowIndex != -1) {
            DefaultTableModel model = (DefaultTableModel) jTable1.getModel();
            tfName.setText(model.getValueAt(selectedRowIndex, 0).toString());
            tfDate.setText(model.getValueAt(selectedRowIndex, 1).toString());
            jcbTime.setSelectedItem(model.getValueAt(selectedRowIndex, 2).toString());
        }
    }

    // Event to handle finishing an appointment
    private void jButtonFinishActionPerformed() {
        DefaultTableModel model = (DefaultTableModel) jTable1.getModel();
        int selectedRowIndex = jTable1.getSelectedRow();

        if (selectedRowIndex == -1) {
            JOptionPane.showMessageDialog(this, "Please select an appointment to finish.");
            return;
        }

        String name = tfName.getText().trim();
        String date = tfDate.getText().trim();
        String time = jcbTime.getSelectedItem().toString();
        String status = jcbStatus.getSelectedItem().toString();

        saveToHistory(name, date, time, status);
        model.removeRow(selectedRowIndex);

        rewriteAppointmentFile(model); // Rewrite appointment.txt with remaining rows

        JOptionPane.showMessageDialog(this, "Appointment finished.");

        loadAppointments();
        loadPreviousAppointments();
    }

    private void rewriteAppointmentFile(DefaultTableModel model) {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter("appointment.txt"))) {
            for (int i = 0; i < model.getRowCount(); i++) {
                String name = model.getValueAt(i, 0).toString();
                String date = model.getValueAt(i, 1).toString();
                String time = model.getValueAt(i, 2).toString();
                writer.write(name + "," + date + "," + time);
                writer.newLine();
            }
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error updating appointments file: " + e.getMessage(), "Error",
                    JOptionPane.ERROR_MESSAGE);
        }
    }

    // Save finished appointments to history file
    private void saveToHistory(String name, String date, String time, String status) {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter("history.txt", true))) {
            writer.write(name + "," + date + "," + time + "," + status);
            writer.newLine();
        } catch (IOException ex) {
            JOptionPane.showMessageDialog(this, "Error saving appointment: " + ex.getMessage(), "Error",
                    JOptionPane.ERROR_MESSAGE);
        }
    }

    // Main method
    public static void main(String args[]) {
        java.awt.EventQueue.invokeLater(() -> new Appointment().setVisible(true));
    }

    // Variables declaration
    private javax.swing.JButton jButtonFinish, jButtonEdit;
    private javax.swing.JComboBox<String> jcbTime, jcbStatus;
    private javax.swing.JLabel jLabel1, jLabel2, jLabel3, jLabel4, jLabel5, jLabel6;
    private javax.swing.JScrollPane jScrollPane1, jScrollPane2;
    private javax.swing.JTable jTable1, jTable2;
    private javax.swing.JTextField tfName, tfDate;
}
