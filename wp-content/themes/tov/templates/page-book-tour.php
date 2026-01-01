<?php
/**
 * Template Name: Book a Tour
 * 
 * Template for booking a tour with modern Tailwind CSS design
 */

get_header(); ?>

<div class="relative isolate bg-white min-h-screen py-24 px-6 lg:px-8">
    <div class="mx-auto max-w-7xl grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
        
        <!-- Left Content Section -->
        <div class="relative px-6 pb-20 pt-28 sm:pt-32 lg:static lg:px-8 lg:py-12">
            <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
                
                <!-- Content -->
                <h2 class="text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Get in touch</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">Schedule your personalized tour of our facility. Select your preferred date and time, and one of our dedicated team members will be in touch shortly to confirm your visit.</p>
                
                <!-- Contact Information -->
                <dl class="mt-10 space-y-4 text-base leading-7 text-gray-600">
                    <div class="flex gap-x-4">
                        <dt class="flex-none">
                            <span class="sr-only">Address</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="h-7 w-6 text-gray-400">
                                <path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </dt>
                        <dd>Ropers Lane, Otterton, Budleigh<br />Salterton East Devon, EX9 7JF</dd>
                    </div>
                    <div class="flex gap-x-4">
                        <dt class="flex-none">
                            <span class="sr-only">Telephone</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="h-7 w-6 text-gray-400">
                                <path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </dt>
                        <dd><a href="tel:01395568208" class="hover:text-gray-900 transition-colors">01395 568208</a></dd>
                    </div>
                    <div class="flex gap-x-4">
                        <dt class="flex-none">
                            <span class="sr-only">Email</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="h-7 w-6 text-gray-400">
                                <path d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </dt>
                        <dd><a href="mailto:enquiries@theoldvicarageotterton.com" class="hover:text-gray-900 transition-colors">enquiries@theoldvicarageotterton.com</a></dd>
                    </div>
                </dl>
                
                <!-- Map -->
                <div class="mt-10 h-[380px] w-full rounded-lg overflow-hidden shadow-lg" style="height: 380px;">
                    <iframe 
                        width="100%" 
                        height="100%" 
                        id="gmap_canvas" 
                        src="https://maps.google.com/maps?q=Ropers%20Lane%2C%20Otterton%2C%20Budleigh%20Salterton%20East%20Devon%2C%20EX9%207JF&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                        frameborder="0" 
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0">
                    </iframe>
                </div>
            </div>
        </div>
        
        <!-- Right Form Section -->
        <div class="px-6 pb-24 pt-28 sm:pb-32 lg:px-8 lg:py-12">
            <form id="book-tour-form" method="post" action="" class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg bg-[#00455E]/5 rounded-[12px] p-[50px]">
                <?php wp_nonce_field('book_tour_nonce', 'book_tour_nonce_field'); ?>
                
                <!-- Tour Type Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold leading-6 text-gray-900 mb-3">PLEASE SELECT TOUR TYPE: (REQUIRED)</label>
                    <div class="flex flex-wrap gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="tour_type" value="brochure" required class="w-4 h-4 text-[#014854] border-gray-300 focus:ring-indigo-600">
                            <span class="text-sm text-gray-900">Download Brochure</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="tour_type" value="visit" required class="w-4 h-4 text-[#014854] border-gray-300 focus:ring-indigo-600">
                            <span class="text-sm text-gray-900">Book a Visit</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="tour_type" value="contact" required class="w-4 h-4 text-[#014854] border-gray-300 focus:ring-indigo-600">
                            <span class="text-sm text-gray-900">Contact Us</span>
                        </label>
                    </div>
                    <p class="mt-2 text-sm text-gray-600">Experience our facility through an immersive virtual tour from the comfort of your home.</p>
                </div>
                
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <!-- Full Name -->
                    <div class="sm:col-span-2">
                        <label for="full_name" class="block text-sm font-semibold leading-6 text-gray-900">FULL NAME (REQUIRED)</label>
                        <div class="mt-2.5">
                            <input type="text" name="full_name" id="full_name" required class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 transition-all duration-200">
                        </div>
                    </div>
                    
                    <!-- Phone Number -->
                    <div class="sm:col-span-2">
                        <label for="phone_number" class="block text-sm font-semibold leading-6 text-gray-900">PHONE NUMBER (REQUIRED)</label>
                        <div class="mt-2.5">
                            <input type="tel" name="phone_number" id="phone_number" required class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 transition-all duration-200">
                        </div>
                    </div>
                    
                    <!-- Email Address -->
                    <div class="sm:col-span-2">
                        <label for="email_address" class="block text-sm font-semibold leading-6 text-gray-900">EMAIL ADDRESS</label>
                        <div class="mt-2.5">
                            <input type="email" name="email_address" id="email_address" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 transition-all duration-200">
                        </div>
                    </div>
                    
                    <!-- Contact Specific Fields -->
                    <div id="contact-fields" class="contents">
                        <!-- Message Field -->
                        <div class="sm:col-span-2">
                            <label for="contact_message" class="block text-sm font-semibold leading-6 text-gray-900">MESSAGE</label>
                            <div class="mt-2.5">
                                <textarea name="contact_message" id="contact_message" rows="4" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 transition-all duration-200 resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Visit Specific Fields -->
                    <div id="visit-fields" class="contents">
                        <!-- Care Home Selection -->
                        <div class="sm:col-span-2">
                            <label for="care_home" class="block text-sm font-semibold leading-6 text-gray-900">CARE HOME (REQUIRED)</label>
                            <div class="mt-2.5">
                                <select id="care_home" name="care_home" required class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 transition-all duration-200">
                                <option value="">Select a care home</option>
                                <option value="otterton">Otterton</option>
                                <option value="exmouth">Exmouth</option>
                                <option value="sidmouth">Sidmouth</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Preferred Date -->
                    <div class="sm:col-span-2">
                        <label for="preferred_date" class="block text-sm font-semibold leading-6 text-gray-900">PREFERRED DATE</label>
                        <div class="mt-2.5">
                            <input type="date" id="preferred_date" name="preferred_date" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 transition-all duration-200">
                        </div>
                    </div>
                    
                    <!-- Preferred Time -->
                    <div class="sm:col-span-2">
                        <label for="preferred_time" class="block text-sm font-semibold leading-6 text-gray-900">PREFERRED TIME</label>
                        <div class="mt-2.5">
                            <select id="preferred_time" name="preferred_time" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 transition-all duration-200">
                                <option value="">Select a time</option>
                                <option value="09:00">9:00 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="14:00">2:00 PM</option>
                                <option value="15:00">3:00 PM</option>
                                <option value="16:00">4:00 PM</option>
                            </select>
                        </div>
                    </div>
                
                </div>
                </div>
                
                <!-- Checkboxes -->
                <div class="mt-6 space-y-4">
                    <!-- Request Call Back Checkbox (Contact Only) -->
                    <div id="callback-checkbox" class="hidden">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <input type="checkbox" name="request_callback" class="mt-1 w-4 h-4 text-[#016A7C] border-gray-300 rounded focus:ring-[#016A7C]">
                            <span class="text-sm text-gray-600">
                                Request a call back
                            </span>
                        </label>
                    </div>
                    
                    <label class="flex items-start gap-3 cursor-pointer group">
                        <input type="checkbox" name="privacy_notice" required class="mt-1 w-4 h-4 text-[#016A7C] border-gray-300 rounded focus:ring-[#016A7C]">
                        <span class="text-sm text-gray-600">
                            I confirm I have read the <a href="#" class="text-[#016A7C] hover:text-[#016A7C] underline">privacy notice</a> (Required)
                        </span>
                    </label>
                    
                    <label class="flex items-start gap-3 cursor-pointer group">
                        <input type="checkbox" name="newsletter" class="mt-1 w-4 h-4 text-[#016A7C] border-gray-300 rounded focus:ring-[#016A7C]">
                        <span class="text-sm text-gray-600">
                            I would like to be kept up-to-date with news from our homes, future offers and services
                        </span>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="btn btn-primary bt-1 w-full">Book Tour</button>
                </div>
                
                <!-- Footer Text -->
                <div class="mt-6">
                    <p class="text-xs text-gray-500 leading-relaxed">
                        This site is protected by reCAPTCHA and the Google 
                        <a href="#" class="text-[#016A7C] hover:text-[#016A7C] underline">Privacy Policy</a> and 
                        <a href="#" class="text-[#016A7C] hover:text-[#016A7C] underline">Terms of Service</a> apply. 
                        We use an application to understand the nature of your enquiry, this maybe retained for 30 days.
                    </p>
                </div>
            </form>
        </div>
        
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
        <!-- Center modal -->
        <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>
        
        <div class="relative inline-block transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6 sm:align-middle">
            <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Booking Successful!</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Your tour booking request has been submitted successfully. We will contact you shortly to confirm your visit and provide further details.</p>
                    </div>
                    <div class="mt-4 rounded-md bg-blue-50 p-4">
                        <div class="text-sm text-left">
                            <p class="font-medium text-blue-800 mb-2">What happens next?</p>
                            <ul class="list-disc list-inside space-y-1 text-blue-700">
                                <li>Our team will review your request</li>
                                <li>We'll contact you within 24 hours to confirm</li>
                                <li>You'll receive detailed information about your tour</li>
                                <li>Check your email for a confirmation message</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <button type="button" onclick="closeSuccessModal()" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('book-tour-form');
    const submitButton = form.querySelector('button[type="submit"]');
    const radioButtons = form.querySelectorAll('input[name="tour_type"]');

    // Field Groups
    const visitFields = document.getElementById('visit-fields');
    const contactFields = document.getElementById('contact-fields');
    const callbackCheckbox = document.getElementById('callback-checkbox');
    const visitInputs = visitFields ? visitFields.querySelectorAll('select, input') : [];
    
    let currentType = 'contact'; // Default

    // Check URL parameters for initial state
    const urlParams = new URLSearchParams(window.location.search);
    const formType = urlParams.get('form') || 'contact';
    const shouldCheckCallback = urlParams.get('callback') === '1';

    // State Management Function
    function updateFormState(type) {
        currentType = type;
        
        // Reset visibility
        if(visitFields) {
            visitFields.classList.add('hidden');
            visitFields.classList.remove('contents');
        }
        if(contactFields) {
            contactFields.classList.add('hidden');
            contactFields.classList.remove('contents');
        }
        if(callbackCheckbox) {
            callbackCheckbox.classList.add('hidden');
        }
        
        // Reset required attributes
        if(visitInputs.length) {
            visitInputs.forEach(input => input.required = false);
        }
        
        // Update Submit Button Text
        let btnText = 'Submit';
        
        if (type === 'brochure') {
            btnText = 'Download Brochure';
        } else if (type === 'visit') {
            btnText = 'Book Tour';
            if(visitFields) {
                visitFields.classList.remove('hidden');
                visitFields.classList.add('contents');
            }
            
            // Re-enable required for visit fields
            const careHome = document.getElementById('care_home');
            if(careHome) careHome.required = true;
            
        } else if (type === 'contact') {
            btnText = 'Send Message';
            if(contactFields) {
                contactFields.classList.remove('hidden');
                contactFields.classList.add('contents');
            }
            if(callbackCheckbox) {
                callbackCheckbox.classList.remove('hidden');
            }
        }
        
        submitButton.textContent = btnText;
        
        // Update Radio Button UI
        radioButtons.forEach(radio => {
            if (radio.value === type) radio.checked = true;
        });
    }
    
    // Form submission handling
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        submitButton.disabled = true;
        const previousText = submitButton.textContent;
        submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sending...';

        // Store selected type before reset
        const selectedType = form.querySelector('input[name="tour_type"]:checked')?.value || 'contact';
        
        // Collect form data
        const formData = new FormData(form);
        formData.append('action', 'tov_contact_form');
        formData.append('nonce', ajax_object.contact_form_nonce);
        formData.append('form_type', selectedType);
        
        // Send AJAX request
        fetch(ajax_object.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Reset form
            form.reset();
            
            // Restore Selection and State
            updateFormState(selectedType);
            
            // Reset button state
            submitButton.disabled = false;
            submitButton.textContent = previousText;
            
            // Show success modal
            showSuccessModal();
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Reset button state
            submitButton.disabled = false;
            submitButton.innerHTML = previousText;
            
            alert('There was an error submitting the form. Please try again.');
        });
    });

    
    
    // Add focus animations to inputs
    const inputs = form.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('scale-[1.01]');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('scale-[1.01]');
        });
    });
    // Handle Radio Changes
    radioButtons.forEach(radio => {
        radio.addEventListener('change', (e) => {
            updateFormState(e.target.value);
        });
    });
    
    // Initialize from URL Param
    if (formType && ['brochure', 'visit', 'contact'].includes(formType)) {
        updateFormState(formType);
    } else {
        // Default to Contact
        updateFormState('contact');
    }

    // Check the callback checkbox if callback parameter is present
    if (shouldCheckCallback && formType === 'contact') {
        const callbackInput = document.querySelector('input[name="request_callback"]');
        if (callbackInput) {
            callbackInput.checked = true;
        }
    }
});

function showSuccessModal() {
    const modal = document.getElementById('successModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close modal on background click
document.getElementById('successModal')?.addEventListener('click', function(e) {
    if (e.target === this || e.target.classList.contains('bg-gray-500')) {
        closeSuccessModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSuccessModal();
    }
});
</script>

<?php get_footer(); ?>
