import java.io.*;
import javax.swing.*;

public class SubmitFeedback extends javax.swing.JFrame {

    public SubmitFeedback() {
        initComponents();
        setLocationRelativeTo(null); // Center the window
    }

    private void initComponents() {
        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        tfID = new javax.swing.JTextField();
        taFeedback = new java.awt.TextArea();
        jButtonSubmit = new javax.swing.JButton();
        jButtonBack = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setTitle("Submit Feedback");

        jLabel1.setFont(new java.awt.Font("Segoe UI", 0, 15));
        jLabel1.setText("Enter ID:");

        jLabel2.setFont(new java.awt.Font("Segoe UI", 0, 15));
        jLabel2.setText("Enter Feedback:");

        jButtonSubmit.setText("Submit");
        jButtonSubmit.addActionListener(evt -> jButtonSubmitActionPerformed(evt));

        jButtonBack.setText("Back");
        jButtonBack.addActionListener(evt -> jButtonBackActionPerformed(evt));

        // Layout setup
        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);

        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addGroup(layout.createSequentialGroup()
                    .addContainerGap(30, Short.MAX_VALUE)
                    .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                        .addComponent(jLabel1)
                        .addComponent(jLabel2))
                    .addGap(30)
                    .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                        .addComponent(tfID, javax.swing.GroupLayout.DEFAULT_SIZE, 200, Short.MAX_VALUE)
                        .addComponent(taFeedback, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                    .addGap(30))
                .addGroup(layout.createSequentialGroup()
                    .addGap(50)
                    .addComponent(jButtonBack, 100, 100, 100)
                    .addGap(30)
                    .addComponent(jButtonSubmit, 100, 100, 100)
                    .addGap(50))
        );

        layout.setVerticalGroup(
            layout.createSequentialGroup()
                .addGap(30)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel1)
                    .addComponent(tfID, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(20)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jLabel2)
                    .addComponent(taFeedback, javax.swing.GroupLayout.PREFERRED_SIZE, 100, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(30)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jButtonBack)
                    .addComponent(jButtonSubmit))
                .addGap(30)
        );

        pack();
    }

    private void jButtonSubmitActionPerformed(java.awt.event.ActionEvent evt) {
        String ID = tfID.getText().trim();
        String feedback = taFeedback.getText().trim();

        if (ID.isEmpty() || feedback.isEmpty()) {
            JOptionPane.showMessageDialog(this, "Please fill out both fields.");
            return;
        }

        saveFeedback(ID, feedback);
        JOptionPane.showMessageDialog(this, "Feedback sent successfully!");

        tfID.setText("");
        taFeedback.setText("");
    }

    private void saveFeedback(String ID, String feedback) {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter("feedback.txt", true))) {
            writer.write(ID + "," + feedback);
            writer.newLine();
        } catch (IOException ex) {
            JOptionPane.showMessageDialog(this, "Error saving feedback: " + ex.getMessage(), "Error", JOptionPane.ERROR_MESSAGE);
        }
    }

    private void jButtonBackActionPerformed(java.awt.event.ActionEvent evt) {
        new DashMenuStudent().setVisible(true);
        dispose();
    }

    public static void main(String args[]) {
        java.awt.EventQueue.invokeLater(() -> new SubmitFeedback().setVisible(true));
    }

    private javax.swing.JButton jButtonSubmit;
    private javax.swing.JButton jButtonBack;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JTextField tfID;
    private java.awt.TextArea taFeedback;
}
