<?php
// Get page URL passed as parameter
$pageUrl = isset($_GET['page_url']) ? htmlspecialchars($_GET['page_url']) : 'General Inquiry';
$pageTitle = isset($_GET['page_title']) ? htmlspecialchars($_GET['page_title']) : '';
?>

<div class="mtc-sidebar-quote-card">
  <div class="mtc-sidebar-title">
    <i class="far fa-envelope"></i>
    <div>
      <span style="display:block; font-size:12px; color:#999; font-weight:600;">QUESTIONS?</span>
      GET A QUOTE
    </div>
  </div>

  <form id="<?php echo $pageUrl; ?>" action="forms/contact.php" method="post" class="ajax-form php-email-form">
    <div class="loading" style="display:none; font-size:12px; margin-bottom:10px;">Sending...</div>
  <div class="error-msg" style="display:none; color:red; font-size:12px; margin-bottom:10px;"></div>
  <div class="sent-message" style="display:none; color:green; font-size:12px; margin-bottom:10px;"></div>
    <input type="text" name="first_name" class="mtc-sidebar-input" placeholder="Full Name" required>
    <input type="email" name="email" class="mtc-sidebar-input" placeholder="Company Email" required>
    <input type="tel" name="contact" class="mtc-sidebar-input" placeholder="Phone Number">
    
    <!-- Hidden field to track page source -->
    <input type="hidden" name="source_page" value="<?php echo $pageUrl; ?>">
    <?php if (!empty($pageTitle)): ?>
      <input type="hidden" name="subject" value="<?php echo $pageTitle; ?>">
    <?php endif; ?>
    
    <textarea name="message" class="mtc-sidebar-input" rows="4" placeholder="I am interested in..." style="resize:none;"></textarea>

    <button type="submit" class="mtc-sidebar-quote-card-btn-orange w-100">
      SEND INQUIRY <i class="fas fa-paper-plane ms-2"></i>
    </button>
    <p class="text-center mt-3 text-muted" style="font-size: 10px;">Your information is secure and will not be shared.</p>
  </form>
</div>

<style>
  /* ============================================ */
  /* SIDEBAR QUOTE FORM STYLES                    */
  /* ============================================ */

  .mtc-sidebar-quote-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    position: sticky;
    top: 100px;
  }

  .mtc-sidebar-title {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .mtc-sidebar-title i {
    color: var(--primary-color, #f03c02);
    background: #fff0eb;
    padding: 8px;
    border-radius: 4px;
  }

  .mtc-sidebar-input {
    background: #f9f9f9;
    border: 1px solid #eee;
    border-radius: 4px;
    padding: 12px;
    font-size: 13px;
    width: 100%;
    margin-bottom: 15px;
    font-family: inherit;
  }

  .mtc-sidebar-input:focus {
    outline: none;
    border-color: var(--primary-color, #f03c02);
    background: #fff;
  }

  .mtc-sidebar-quote-card-btn-orange {
    background: var(--primary-color, #f03c02);
    color: #fff;
    padding: 12px 30px;
    font-weight: 700;
    text-transform: uppercase;
    border-radius: 4px;
    border: none;
    font-size: 13px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    width: 100%;
    justify-content: center;
  }

  .mtc-sidebar-quote-card-btn-orange:hover {
    background: #d93602;
    color: #fff;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .mtc-sidebar-quote-card {
      position: static;
      margin-top: 30px;
    }
  }
</style>
