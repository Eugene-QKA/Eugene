import javax.swing.*;

public class DashMenuStudent extends JFrame {

    /**
     * Creates new form DashMenuStudent
     */
    public DashMenuStudent() {
        setTitle("Student Dashboard Menu");
        initComponents();
        setLocationRelativeTo(null);
    }

    private void initComponents() {
        JLabel jLabel1 = new JLabel("Student Dashboard Menu", SwingConstants.CENTER);
        jLabel1.setFont(new java.awt.Font("Segoe UI", 0, 30));
        jLabel1.setForeground(new java.awt.Color(51, 51, 255));

        JButton jButtonBookConsultation = new JButton("Book Consultation");
        JButton jButtonRescheduleRequest = new JButton("Reschedule Request");
        JButton jButtonFeedback = new JButton("Feedback");
        JButton jButtonLogout = new JButton("Logout");

        // Set button actions
        jButtonBookConsultation.addActionListener(evt -> openWindow(new Booking()));
        jButtonRescheduleRequest.addActionListener(evt -> openWindow(new RequestBooking()));
        jButtonFeedback.addActionListener(evt -> openWindow(new SubmitFeedback()));
        jButtonLogout.addActionListener(evt -> logout());

        // Layout setup using GroupLayout
        GroupLayout layout = new GroupLayout(getContentPane());
        getContentPane().setLayout(layout);

        layout.setHorizontalGroup(
            layout.createParallelGroup(GroupLayout.Alignment.CENTER)
                .addGroup(layout.createSequentialGroup()
                    .addGap(56)
                    .addGroup(layout.createParallelGroup(GroupLayout.Alignment.CENTER)
                        .addComponent(jButtonBookConsultation, 215, 215, 215)
                        .addComponent(jButtonRescheduleRequest, 215, 215, 215)
                        .addComponent(jButtonFeedback, 215, 215, 215)
                        .addComponent(jButtonLogout, 215, 215, 215))
                    .addGap(56))
                .addGroup(layout.createSequentialGroup()
                    .addContainerGap()
                    .addComponent(jLabel1, GroupLayout.DEFAULT_SIZE, GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addContainerGap())
        );

        layout.setVerticalGroup(
            layout.createSequentialGroup()
                .addGap(38)
                .addComponent(jLabel1)
                .addGap(48)
                .addComponent(jButtonBookConsultation, 34, 34, 34)
                .addGap(20)
                .addComponent(jButtonRescheduleRequest, 34, 34, 34)
                .addGap(20)
                .addComponent(jButtonFeedback, 34, 34, 34)
                .addGap(20)
                .addComponent(jButtonLogout, 34, 34, 34)
                .addGap(50)
        );

        pack();
    }

    private void openWindow(JFrame window) {
        window.setVisible(true);
        this.dispose();
    }

    private void logout() {
        int confirm = JOptionPane.showConfirmDialog(this, "Are you sure you want to logout?", "Logout Confirmation", JOptionPane.YES_NO_OPTION);
        if (confirm == JOptionPane.YES_OPTION) {
            new LogIn().setVisible(true); // Replace 'Login' with your actual login class
            this.dispose();
        }
    }

    public static void main(String args[]) {
        // Set Nimbus Look and Feel
        try {
            for (UIManager.LookAndFeelInfo info : UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (Exception ex) {
            System.err.println("Failed to initialize Nimbus Look and Feel: " + ex.getMessage());
        }

        // Launch the form
        java.awt.EventQueue.invokeLater(() -> new DashMenuStudent().setVisible(true));
    }
}
