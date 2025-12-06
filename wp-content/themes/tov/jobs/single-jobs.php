<?php
/**
 * Template Name: Single Job Template
 * 
 * INSTRUCTIONS:
 * 1. Upload this file to your theme folder
 * 2. Rename it to "single-jobs.php"
 * 3. This template will automatically be used for individual job pages
 */

get_header(); 

// Check if we're on a job post
if (!is_singular('jobs')) {
    // Debug: Let's see what post type we're actually on
    global $post;
    if ($post) {
        echo '<!-- Debug: Post type is: ' . $post->post_type . ' -->';
    }
    // If not a job post, show 404
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part('404');
    exit;
}

// Check if job is active (but don't block if status is not set)
$job_status = get_post_meta(get_the_ID(), '_job_status', true);

// Only show 404 if job is explicitly set to inactive
if ($job_status === 'inactive') {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part('404');
    exit;
}
?>



<div class="min-h-screen bg-white py-8 lg:py-24">
    <div class="max-w-[1280px] mx-auto px-4 py-16 sm:px-6 relative z-10">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-24">
            <!-- Left Column - Job Details (2/3) -->
            <div class="lg:w-2/3">
                <?php while (have_posts()) : the_post(); ?>
                    <?php 
                    $category = get_post_meta(get_the_ID(), '_job_category', true);
                    $job_type = get_post_meta(get_the_ID(), '_job_type', true);
                    $location = get_post_meta(get_the_ID(), '_job_location', true);
                    ?>
                    
                    <!-- Job Title -->
                    <h1 class="text-[#00455E] font-poppins text-3xl md:text-4xl font-semibold mb-6 leading-tight"><?php the_title(); ?></h1>
                    
                    <!-- Job Metadata -->
                    <div class="space-y-2 mb-8">
                        <?php if ($category) : ?>
                            <div class="flex items-start">
                                <span class="text-[#00455E] font-inter text-sm font-medium min-w-[110px]">Job Category</span>
                                <span class="text-gray-600 font-inter text-sm"><span class="pl-2">:</span> <?php echo esc_html($category); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($job_type) : ?>
                            <div class="flex items-start">
                                <span class="text-[#00455E] font-inter text-sm font-medium min-w-[110px]">Job Type</span>
                                <span class="text-gray-600 font-inter text-sm"><span class="pl-2">:</span> <?php echo ucfirst(str_replace('-', ' ', $job_type)); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($location) : ?>
                            <div class="flex items-start">
                                <span class="text-[#00455E] font-inter text-sm font-medium min-w-[110px]">Job Location</span>
                                <span class="text-gray-600 font-inter text-sm"><span class="pl-2">:</span> <?php echo esc_html($location); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="border-b border-gray-200 my-6"></div>
                    
                    <!-- Job Description -->
                    <div class="job-content prose prose-sm lg:prose-base max-w-none text-gray-700 leading-relaxed">
                        <?php the_content(); ?>
                    </div>
                    
                <?php endwhile; ?>
            </div>
            
            <!-- Right Column - Apply Form (1/3) -->
            <div class="w-full lg:w-1/3 lg:flex-shrink-0">
                <div class="bg-gray-50 rounded-lg p-6 lg:p-8 border border-gray-200 lg:sticky lg:top-6">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-900 mb-6">Apply Now</h2>
                    
                    <form id="job-application-form" method="post" enctype="multipart/form-data" class="space-y-4">
                        <?php wp_nonce_field('job_application_nonce', 'job_application_nonce_field'); ?>
                        <input type="hidden" name="job_id" value="<?php echo get_the_ID(); ?>">
                        
                        <div>
                            <input type="text" id="applicant_name" name="applicant_name" placeholder="Name*" required class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white transition-all">
                        </div>
                        
                        <div>
                            <input type="email" id="applicant_email" name="applicant_email" placeholder="Email*" required class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white transition-all">
                        </div>
                        
                        <div>
                            <input type="tel" id="applicant_phone" name="applicant_phone" placeholder="Phone*" required class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white transition-all">
                        </div>
                        
                        <div>
                            <textarea id="cover_letter" name="cover_letter" rows="4" placeholder="Cover Letter" class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white resize-none transition-all"></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Resume</label>
                            <input type="file" id="resume_upload" name="resume_upload" accept=".pdf,.doc,.docx" required class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer transition-all">
                            <p class="text-xs text-gray-500 mt-2">Allowed Type(s): .pdf, .doc, .docx</p>
                        </div>
                        
                        <div class="flex items-start pt-2">
                            <input type="checkbox" name="privacy_policy" required id="privacy_policy" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                            <label for="privacy_policy" class="ml-3 text-sm text-gray-700 cursor-pointer select-none">I accept the Privacy Policy</label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary bt-1 w-full">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Thank You Modal -->
<div id="thankYouModal" class="fixed inset-0 w-full h-full bg-black/50 backdrop-blur-sm flex justify-center items-center z-[10000] hidden">
    <div class="bg-white rounded-2xl p-10 text-center max-w-md w-11/12 shadow-2xl animate-[modalSlideIn_0.3s_ease-out]">
        <div class="mb-6">
            <div class="w-20 h-20 rounded-full border-2 border-white flex justify-center items-center mx-auto bg-[#00323F]">
                <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 12L11 14L15 10" stroke="#FF6B6B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
        <h2 class="font-jakarta text-3xl font-bold text-gray-800 mb-4">Thank you</h2>
        <p class="font-lato text-base text-gray-600 leading-relaxed mb-8">your message has been received,<br>we will update you shortly.</p>
        <button class="bg-[#00323F] text-white border-none py-3.5 px-8 rounded-xl font-lato text-base font-medium cursor-pointer transition-all hover:bg-[#00323F] hover:-translate-y-px hover:shadow-[0_4px_12px_rgba(61,213,243,0.3)] active:translate-y-0 min-w-[140px]" onclick="closeThankYouModal()">Go further</button>
    </div>
</div>

<style>
/* Keyframe animation for modal */
@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Legacy WordPress content styles - keep for backward compatibility */
.job-content ul {
    list-style: none;
    padding: 0;
    margin: 0 !important;
}

.job-content ul li {
    padding: 3px 0;
    display: flex;
    align-items: flex-start;
    word-wrap: break-word;
    position: relative;
    padding-left: 30px;
    color: rgba(60, 74, 78, 0.80);
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
}

.job-content ul li::before {
    content: "✓";
    color: #19A1AF;
    font-weight: bold;
    font-size: 14px;
    position: absolute;
    left: 0;
    top: 8px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: rgba(25, 161, 175, 0.13);
    display: flex;
    align-items: center;
    justify-content: center;
}

.job-content p {
    margin-bottom: 15px;
    word-wrap: break-word;
    color: rgba(60, 74, 78, 0.80);
    font-family: Inter;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
}

.job-content h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 20px;
    font-weight: 600 !important;
    color: #00455E;
    margin: 0 0 15px 0;
    text-transform: none;
    padding-top: 32px;
    padding-bottom: 10px;
}
</style>

<script>
// Modal functions
function showThankYouModal() {
    document.getElementById('thankYouModal').style.display = 'flex';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closeThankYouModal() {
    document.getElementById('thankYouModal').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('thankYouModal');
    if (event.target === modal) {
        closeThankYouModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeThankYouModal();
    }
});
</script>

<?php get_footer(); ?>
