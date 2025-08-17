import javax.swing.*;

public class DashMenu extends JFrame {

    /**
     * Creates new form DashMenu
     */
    public DashMenu() {
        setTitle("Dashboard Menu");
        initComponents();
        setLocationRelativeTo(null);
    }

    private void initComponents() {
        JLabel jLabel1 = new JLabel("Dashboard Menu", SwingConstants.CENTER);
        jLabel1.setFont(new java.awt.Font("Segoe UI", 0, 30));
        jLabel1.setForeground(new java.awt.Color(51, 51, 255));

        JButton jButton1 = new JButton("Consultation Slot Management");
        JButton jButton2 = new JButton("Reschedule Request");
        JButton jButton3 = new JButton("Feedback");
        JButton jButton4 = new JButton("View Appointment");
        JButton jButtonLogout = new JButton("Logout");

        // Set button actions
        jButton1.addActionListener(evt -> openWindow(new Consultation()));
        jButton2.addActionListener(evt -> openWindow(new Request()));
        jButton3.addActionListener(evt -> openWindow(new Feedback()));
        jButton4.addActionListener(evt -> openWindow(new Appointment()));
        jButtonLogout.addActionListener(evt -> logout());

        // Layout setup using GroupLayout
        GroupLayout layout = new GroupLayout(getContentPane());
        getContentPane().setLayout(layout);

        layout.setHorizontalGroup(
            layout.createParallelGroup(GroupLayout.Alignment.CENTER)
                .addGroup(layout.createSequentialGroup()
                    .addGap(56)
                    .addGroup(layout.createParallelGroup(GroupLayout.Alignment.LEADING, false)
                        .addComponent(jButton1, 215, 215, 215)
                        .addComponent(jButton2, 215, 215, 215))
                    .addGap(50)
                    .addGroup(layout.createParallelGroup(GroupLayout.Alignment.LEADING, false)
                        .addComponent(jButton4, 215, 215, 215)
                        .addComponent(jButton3, 215, 215, 215))
                    .addGap(56))
                .addGroup(layout.createSequentialGroup()
                    .addContainerGap()
                    .addComponent(jLabel1, GroupLayout.DEFAULT_SIZE, GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addContainerGap())
                .addGroup(layout.createSequentialGroup()
                    .addGap(200)
                    .addComponent(jButtonLogout, 215, 215, 215)
                    .addGap(200))
        );

        layout.setVerticalGroup(
            layout.createSequentialGroup()
                .addGap(38)
                .addComponent(jLabel1)
                .addGap(48)
                .addGroup(layout.createParallelGroup(GroupLayout.Alignment.BASELINE)
                    .addComponent(jButton1, 34, 34, 34)
                    .addComponent(jButton4, 34, 34, 34))
                .addGap(50)
                .addGroup(layout.createParallelGroup(GroupLayout.Alignment.BASELINE)
                    .addComponent(jButton2, 34, 34, 34)
                    .addComponent(jButton3, 34, 34, 34))
                .addGap(50)
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
        java.awt.EventQueue.invokeLater(() -> new DashMenu().setVisible(true));
    }
}
