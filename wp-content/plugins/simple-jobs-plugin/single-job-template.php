<?php
/**
 * Custom Single Job Template
 * This template displays individual job details in the same model as the Drone Bootcamps page
 */

get_header(); ?>

<div class="job-detail-container">
    <div class="job-content-wrapper">
        <div class="job-main-content">
            <?php while (have_posts()) : the_post(); ?>
                <?php 
                $category = get_post_meta(get_the_ID(), '_job_category', true);
                $job_type = get_post_meta(get_the_ID(), '_job_type', true);
                $location = get_post_meta(get_the_ID(), '_job_location', true);
                $salary = get_post_meta(get_the_ID(), '_job_salary', true);
                $company = get_post_meta(get_the_ID(), '_job_company', true);
                ?>
                
                <div class="job-header">
                    <h1 class="job-title"><?php the_title(); ?></h1>
                    <p class="job-company-location"><?php echo esc_html($company); ?> - <?php echo esc_html($location); ?></p>
                </div>
                
                <div class="job-highlights">
                    <div class="job-badge">
                        <span class="badge-icon">⏱️</span>
                        <span class="badge-text"><?php echo ucfirst(str_replace('-', ' ', $job_type)); ?></span>
                    </div>
                    <div class="job-badge">
                        <span class="badge-icon">📍</span>
                        <span class="badge-text"><?php echo esc_html($location); ?></span>
                    </div>
                    <?php if ($salary) : ?>
                    <div class="job-badge">
                        <span class="badge-icon">💰</span>
                        <span class="badge-text"><?php echo esc_html($salary); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="job-description">
                    <div class="job-content">
                        <?php the_content(); ?>
                    </div>
                </div>
                
                <?php 
                $responsibilities = get_post_meta(get_the_ID(), '_job_responsibilities', true);
                if (!empty($responsibilities)) : 
                ?>
                <div class="job-responsibilities">
                    <h2>Responsibilities</h2>
                    <ul class="responsibilities-list">
                        <?php 
                        $responsibility_lines = explode("\n", $responsibilities);
                        foreach ($responsibility_lines as $line) {
                            $line = trim($line);
                            if (!empty($line)) {
                                echo '<li>' . esc_html($line) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <?php 
                $requirements = get_post_meta(get_the_ID(), '_job_requirements', true);
                if (!empty($requirements)) : 
                ?>
                <div class="job-requirements">
                    <h2>Requirements</h2>
                    <ul class="requirements-list">
                        <?php 
                        $requirement_lines = explode("\n", $requirements);
                        foreach ($requirement_lines as $line) {
                            $line = trim($line);
                            if (!empty($line)) {
                                echo '<li>' . esc_html($line) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
                
            <?php endwhile; ?>
        </div>
        
        <div class="job-application-form">
            <div class="form-container">
                <h2>Apply for this Position</h2>
                <form id="job-application-form" method="post" enctype="multipart/form-data">
                    <?php wp_nonce_field('job_application_nonce', 'job_application_nonce_field'); ?>
                    <input type="hidden" name="job_id" value="<?php echo get_the_ID(); ?>">
                    
                    <div class="form-group">
                        <label for="applicant_name">Full Name *</label>
                        <input type="text" id="applicant_name" name="applicant_name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_email">Email Address *</label>
                        <input type="email" id="applicant_email" name="applicant_email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_phone">Phone Number</label>
                        <input type="tel" id="applicant_phone" name="applicant_phone">
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_location">Current Location</label>
                        <input type="text" id="applicant_location" name="applicant_location">
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_experience">Years of Experience</label>
                        <select id="applicant_experience" name="applicant_experience">
                            <option value="">Select Experience</option>
                            <option value="0-1">0-1 years</option>
                            <option value="2-3">2-3 years</option>
                            <option value="4-5">4-5 years</option>
                            <option value="6-10">6-10 years</option>
                            <option value="10+">10+ years</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="resume_upload">Upload Resume *</label>
                        <input type="file" id="resume_upload" name="resume_upload" accept=".pdf,.doc,.docx" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cover_letter">Cover Letter</label>
                        <textarea id="cover_letter" name="cover_letter" rows="4" placeholder="Tell us why you're interested in this position..."></textarea>
                    </div>
                    
                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="privacy_policy" required>
                            <span class="checkmark"></span>
                            I accept the Privacy Policy and agree to the processing of my personal data
                        </label>
                    </div>
                    
                    <button type="submit" class="submit-btn">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.job-detail-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
}

.job-content-wrapper {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
    align-items: start;
}

.job-main-content {
    background: #f8f9fa;
    padding: 0;
}

.job-header {
    margin-bottom: 30px;
}

.job-title {
    font-size: 28px;
    font-weight: 700;
    color: #2d3748;
    margin: 0 0 15px 0;
    line-height: 1.3;
}

.job-company-location {
    font-size: 16px;
    color: #4a5568;
    margin: 0 0 20px 0;
    font-weight: 500;
}

.job-highlights {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 30px;
}

.job-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #e6f3ff;
    color: #2d3748;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 14px;
    border: 1px solid #cbd5e0;
}

.badge-icon {
    font-size: 16px;
}

.job-description,
.job-responsibilities,
.job-requirements {
    margin-bottom: 30px;
}

.job-description h2,
.job-responsibilities h2,
.job-requirements h2 {
    font-size: 20px;
    font-weight: 600;
    color: #2d3748;
    margin: 0 0 15px 0;
    text-transform: none;
}

.job-content {
    font-size: 16px;
    line-height: 1.6;
    color: #333;
}

.responsibilities-list,
.requirements-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.responsibilities-list li,
.requirements-list li {
    padding: 8px 0;
    font-size: 16px;
    color: #2d3748;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    line-height: 1.5;
}

.responsibilities-list li::before,
.requirements-list li::before {
    content: "✓";
    color: #4a90e2;
    font-weight: bold;
    font-size: 16px;
    flex-shrink: 0;
    margin-top: 2px;
}

.job-application-form {
    position: sticky;
    top: 20px;
}

.form-container {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 12px;
    border: 1px solid #e0e0e0;
}

.form-container h2 {
    font-size: 24px;
    font-weight: 600;
    color: #1a365d;
    margin: 0 0 25px 0;
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
    font-size: 14px;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #d0d0d0;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.2s ease;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #1a365d;
    box-shadow: 0 0 0 2px rgba(26, 54, 93, 0.1);
}

.checkbox-group {
    margin-bottom: 25px;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    cursor: pointer;
    font-size: 14px;
    line-height: 1.4;
}

.checkbox-label input[type="checkbox"] {
    width: auto;
    margin: 0;
}

.submit-btn {
    width: 100%;
    background: #1a365d;
    color: white;
    border: none;
    padding: 14px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.submit-btn:hover {
    background: #153a5e;
}

.submit-btn:active {
    transform: translateY(1px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .job-content-wrapper {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .job-application-form {
        position: static;
    }
    
    .job-title {
        font-size: 28px;
    }
    
    .job-highlights {
        flex-direction: column;
        gap: 10px;
    }
}

/* Success/Error Messages */
.application-message {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
}

.application-message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.application-message.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>

<?php get_footer(); ?>