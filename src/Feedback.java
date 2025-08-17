import java.io.*;
import javax.swing.*;
import javax.swing.table.DefaultTableModel;

public class Feedback extends javax.swing.JFrame {

    public Feedback() {
        initComponents();
        setLocationRelativeTo(null); // Center the window
        loadFeedback();
    }

    private void initComponents() {
        jScrollPane = new javax.swing.JScrollPane();
        jTable = new javax.swing.JTable();
        jButtonBack = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setTitle("View Feedback");

        jTable.setModel(new DefaultTableModel(new Object[][]{}, new String[]{"ID", "Feedback"}));
        jScrollPane.setViewportView(jTable);

        jButtonBack.setText("Back");
        jButtonBack.addActionListener(evt -> jButtonBackActionPerformed(evt));

        // Layout setup
        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);

        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addComponent(jScrollPane, javax.swing.GroupLayout.DEFAULT_SIZE, 400, Short.MAX_VALUE)
                .addGroup(layout.createSequentialGroup()
                    .addGap(150)
                    .addComponent(jButtonBack, 100, 100, 100)
                    .addGap(150))
        );

        layout.setVerticalGroup(
            layout.createSequentialGroup()
                .addComponent(jScrollPane, javax.swing.GroupLayout.PREFERRED_SIZE, 250, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(20)
                .addComponent(jButtonBack)
                .addGap(20)
        );

        pack();
    }

    private void loadFeedback() {
        DefaultTableModel model = (DefaultTableModel) jTable.getModel();
        model.setRowCount(0);

        try (BufferedReader reader = new BufferedReader(new FileReader("feedback.txt"))) {
            String line;
            while ((line = reader.readLine()) != null) {
                String[] parts = line.split(",", 2);
                if (parts.length == 2) {
                    model.addRow(new Object[]{parts[0], parts[1]});
                }
            }
        } catch (IOException ex) {
            JOptionPane.showMessageDialog(this, "Error reading feedback: " + ex.getMessage(), "Error", JOptionPane.ERROR_MESSAGE);
        }
    }

    private void jButtonBackActionPerformed(java.awt.event.ActionEvent evt) {
        new DashMenu().setVisible(true);
        dispose();
    }

    public static void main(String args[]) {
        java.awt.EventQueue.invokeLater(() -> new Feedback().setVisible(true));
    }

    private javax.swing.JButton jButtonBack;
    private javax.swing.JScrollPane jScrollPane;
    private javax.swing.JTable jTable;
}
