<?php require base_path('views/partials/auth/auth.php') ?>
<main style="max-width: 1200px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f4f7fa;">
    <!-- Complaint Details Section -->
    <section style="background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px;">
        <h2 style="color: #333; margin: 0 0 15px; font-size: 24px;">Complaint #101</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <p style="margin: 5px 0; color: #555;"><strong>Subject:</strong> Unprofessional Behavior</p>
                <p style="margin: 5px 0; color: #555;"><strong>Complainant:</strong> John Doe</p>
                <p style="margin: 5px 0; color: #555;"><strong>Accused:</strong> Jane Smith</p>
                <p style="margin: 5px 0; color: #555;"><strong>Status:</strong> <span style="color: #e67e22; background: #fff3e0; padding: 2px 8px; border-radius: 12px;">In Review</span></p>
            </div>
            <div>
                <p style="margin: 5px 0; color: #555;"><strong>Date Filed:</strong> 2025-04-15 14:30</p>
                <p style="margin: 5px 0; color: #555;"><strong>Complaint Type:</strong> Workplace Issue</p>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <h3 style="color: #333; font-size: 18px; margin: 0 0 10px;">Description</h3>
            <p style="color: #555; line-height: 1.6; background: #f9f9f9; padding: 15px; border-radius: 6px;">
                On April 10th, during the team meeting, Jane Smith made inappropriate comments that were unprofessional and disruptive to the team’s morale. The behavior was witnessed by multiple team members and needs to be addressed promptly.
            </p>
        </div>
    </section>

    <!-- Chat Section -->
    <section style="background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #333; margin: 0 0 15px; font-size: 24px;">Conversation</h2>
        <div style="max-height: 400px; overflow-y: auto; padding: 10px; border: 1px solid #e0e0e0; border-radius: 6px; margin-bottom: 20px;">
            <!-- Message 1 -->
            <div style="margin-bottom: 15px;">
                <p style="margin: 0; color: #555; font-size: 14px;"><strong>John Doe</strong> <span style="color: #888;">(2025-04-15 14:35)</span></p>
                <p style="background: #e3f2fd; padding: 10px; border-radius: 6px; margin: 5px 0; color: #333;">
                    I would like to discuss the incident further. Can we have a meeting to resolve this?
                </p>
            </div>
            <!-- Message 2 -->
            <div style="margin-bottom: 15px; text-align: right;">
                <p style="margin: 0; color: #555; font-size: 14px;"><strong>Admin</strong> <span style="color: #888;">(2025-04-15 15:10)</span></p>
                <p style="background: #c8e6c9; padding: 10px; border-radius: 6px; margin: 5px 0; color: #333; display: inline-block;">
                    Thank you for bringing this to our attention, John. We’ve scheduled a meeting for tomorrow at 10 AM. You’ll receive a calendar invite shortly.
                </p>
            </div>
            <!-- Message 3 -->
            <div style="margin-bottom: 15px;">
                <p style="margin: 0; color: #555; font-size: 14px;"><strong>John Doe</strong> <span style="color: #888;">(2025-04-15 15:15)</span></p>
                <p style="background: #e3f2fd; padding: 10px; border-radius: 6px; margin: 5px 0; color: #333;">
                    Sounds good. Thanks for the quick response!
                </p>
            </div>
        </div>

        <!-- Message Input -->
        <div style="display: flex; gap: 10px;">
            <textarea style="flex: 1; padding: 10px; border: 1px solid #e0e0e0; border-radius: 6px; resize: vertical; font-size: 14px;" placeholder="Type your message..."></textarea>
            <button style="padding: 10px 20px; background: #1976d2; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; transition: background 0.2s;">
                Send
            </button>
        </div>
    </section>
</main>
<?php require base_path('views/partials/auth/auth-close.php') ?> 
