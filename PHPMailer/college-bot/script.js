// ========== DOM Elements ==========
const chatToggleBtn = document.getElementById('chat-toggle-btn');
const chatWindow = document.getElementById('chat-window');
const chatCloseBtn = document.getElementById('chat-close-btn');
const chatInput = document.getElementById('chat-input');
const chatSendBtn = document.getElementById('chat-send-btn');
const chatMessages = document.getElementById('chat-messages');
const iconOpen = document.getElementById('chat-icon-open');
const iconClose = document.getElementById('chat-icon-close');

// ========== Toggle Chat Window ==========
function openChat() {
    chatWindow.classList.add('active');
    iconOpen.style.display = 'none';
    iconClose.style.display = 'block';
    chatInput.focus();
}

function closeChat() {
    chatWindow.classList.remove('active');
    iconOpen.style.display = 'block';
    iconClose.style.display = 'none';
}

chatToggleBtn.addEventListener('click', function () {
    if (chatWindow.classList.contains('active')) {
        closeChat();
    } else {
        openChat();
    }
});

chatCloseBtn.addEventListener('click', closeChat);

// ========== Message Helpers ==========
function stripMarkdown(text) {
    // Remove bold **text** or __text__
    text = text.replace(/\*\*(.*?)\*\*/g, '$1');
    text = text.replace(/__(.*?)__/g, '$1');
    // Remove italic *text* or _text_
    text = text.replace(/\*(.*?)\*/g, '$1');
    // Remove heading markers
    text = text.replace(/^#{1,6}\s*/gm, '');
    // Replace markdown bullet * with dash
    text = text.replace(/^\*\s+/gm, '- ');
    return text.trim();
}

function appendMessage(text, sender) {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('message', sender === 'user' ? 'user-message' : 'bot-message');

    const bubble = document.createElement('div');
    bubble.classList.add('message-bubble');

    if (sender === 'bot') {
        // Clean markdown and render line breaks
        const cleaned = stripMarkdown(text);
        bubble.innerHTML = cleaned.replace(/\n/g, '<br>');
    } else {
        bubble.textContent = text;
    }

    messageDiv.appendChild(bubble);
    chatMessages.appendChild(messageDiv);
    scrollToBottom();
}

function showTypingIndicator() {
    const typingDiv = document.createElement('div');
    typingDiv.classList.add('message', 'typing-indicator');
    typingDiv.id = 'typing-indicator';

    const bubble = document.createElement('div');
    bubble.classList.add('message-bubble');

    const textSpan = document.createElement('span');
    textSpan.textContent = 'Thinking';
    textSpan.style.marginRight = '6px';
    textSpan.style.fontWeight = '500';
    textSpan.style.fontSize = '13px';
    textSpan.style.color = '#64748b';
    bubble.appendChild(textSpan);

    for (let i = 0; i < 3; i++) {
        const dot = document.createElement('span');
        dot.classList.add('typing-dot');
        bubble.appendChild(dot);
    }

    typingDiv.appendChild(bubble);
    chatMessages.appendChild(typingDiv);
    scrollToBottom();
}

function removeTypingIndicator() {
    const typingEl = document.getElementById('typing-indicator');
    if (typingEl) {
        typingEl.remove();
    }
}

function scrollToBottom() {
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// ========== Send Message ==========
async function sendMessage() {
    const message = chatInput.value.trim();
    if (!message) return;

    // Show user message
    appendMessage(message, 'user');
    chatInput.value = '';
    chatInput.focus();

    // Show typing indicator
    showTypingIndicator();

    try {
        const response = await fetch('chat.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message: message })
        });

        const data = await response.json();
        removeTypingIndicator();

        if (data.reply) {
            appendMessage(data.reply, 'bot');
        } else {
            appendMessage('Sorry, something went wrong. Please try again.', 'bot');
        }
    } catch (error) {
        removeTypingIndicator();
        appendMessage('Unable to connect. Please check your connection and try again.', 'bot');
    }
}

// ========== Event Listeners ==========
chatSendBtn.addEventListener('click', sendMessage);

chatInput.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        sendMessage();
    }
});

// ========== Quick Tab Pre-Answered Data ==========
const quickTabData = {
    fees: {
        title: '💰 Fee Structure',
        body: `UG programs (B.Sc, B.Com, BBA, BCA) range from ₹84,000 to ₹1,50,000 for the entire duration.

PG programs:
- M.Com / M.Sc — ₹68,000 (full course)
- MBA — ₹2,20,000

Fees start as low as ₹9,000. Exact fees depend on the program you choose.`
    },
    courses: {
        title: '📚 Courses Offered',
        body: `We offer 32 courses across 21 programs!

UG Programs:
- B.Com (General, CA, PA)
- B.Sc (CS, IT, AI & ML, AI & DS, Maths)
- BBA (General, CA)
- BCA

PG Programs:
- M.Com, M.Sc (IT, CS), MBA

Also: Ph.D, M.Phil, and PG Diplomas available.`
    },
    apply: {
        title: '📝 How to Apply',
        body: `Admissions are merit-based. Here's how:

1. Apply online at kkcas.edu.in or visit the campus
2. Bring: 12th marksheets, ID proof, photographs
3. Application period: May–June (after 12th results)
4. Academic year starts: August–September

UG eligibility: 10+2 from a recognized board
PG eligibility: Bachelor's degree in relevant subject`
    },
    placements: {
        title: '💼 Placements',
        body: `Our Training & Placement Cell actively connects students with top recruiters.

Top recruiters: Amazon, Cognizant, Infosys, TCS, Wipro, HDFC Bank, Nvidia, CISCO, Genpact

Services provided:
- Placement training & workshops
- Resume writing & interview skills
- Soft skills training
- Industry visits & career counseling`
    },
    hostel: {
        title: '🏠 Hostel Facilities',
        body: `Both boys and girls hostels are available within the campus.

- Capacity: 102 students each
- Indoor games available
- Dedicated first-year hostel for boys
- Secure environment for girls
- 24/7 ambulance service on campus`
    },
    campus: {
        title: '🏫 Campus & Facilities',
        body: `10-acre green campus with modern infrastructure:

- 4 computer labs (306 computers)
- Library with 14,668+ books
- 1,300-seat auditorium
- Wi-Fi enabled campus
- Canteen, Gym, ATM, Medical facility
- Transport from city
- Sports: Basketball, Volleyball, Badminton, Kabaddi & more`
    }
};

// ========== Quick Tab Click Handlers ==========
document.querySelectorAll('.quick-tab').forEach(tab => {
    tab.addEventListener('click', function () {
        const tabKey = this.dataset.tab;
        const data = quickTabData[tabKey];
        if (!data) return;

        // Toggle active style
        document.querySelectorAll('.quick-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');

        // Build info card
        const card = document.createElement('div');
        card.classList.add('info-card');

        const title = document.createElement('div');
        title.classList.add('info-card-title');
        title.textContent = data.title;

        const body = document.createElement('div');
        body.classList.add('info-card-body');
        body.innerHTML = data.body.replace(/\n/g, '<br>');

        const ctaBtn = document.createElement('button');
        ctaBtn.classList.add('info-card-cta');
        ctaBtn.textContent = '📧 Get full info via email';
        ctaBtn.addEventListener('click', () => showEmailForm(tabKey));

        card.appendChild(title);
        card.appendChild(body);
        card.appendChild(ctaBtn);

        chatMessages.appendChild(card);
        scrollToBottom();
    });
});

// ========== Email Form Card ==========
function showEmailForm(topic) {
    // Don't add duplicate forms
    const existing = document.getElementById('email-form-card');
    if (existing) existing.remove();

    const formCard = document.createElement('div');
    formCard.classList.add('email-form-card');
    formCard.id = 'email-form-card';

    const topicLabel = quickTabData[topic] ? quickTabData[topic].title : 'College Info';

    formCard.innerHTML = `
        <h4>📬 Get ${topicLabel} details via email</h4>
        <input type="text" id="form-name" placeholder="Your Name" required>
        <input type="email" id="form-email" placeholder="Your Email" required>
        <input type="tel" id="form-phone" placeholder="Phone Number (optional)">
        <button class="form-submit-btn" id="form-submit-btn">Send me the details</button>
    `;

    chatMessages.appendChild(formCard);
    scrollToBottom();

    // Handle submit
    document.getElementById('form-submit-btn').addEventListener('click', function () {
        const name = document.getElementById('form-name').value.trim();
        const email = document.getElementById('form-email').value.trim();

        if (!name || !email) {
            appendMessage('Please fill in your name and email! 😊', 'bot');
            return;
        }

        // Remove the form
        formCard.remove();

        // Show confirmation
        appendMessage(
            `Thanks ${name}! 🎉 We've noted your request. Our team will send you detailed ${topicLabel} information at ${email} soon!`,
            'bot'
        );
    });
}

// ====================================================
// LANDING PAGE — FAQ Accordion
// ====================================================
document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', function () {
        const item = this.closest('.faq-item');
        const isActive = item.classList.contains('active');

        // Close all others
        document.querySelectorAll('.faq-item').forEach(faq => faq.classList.remove('active'));

        // Toggle clicked
        if (!isActive) {
            item.classList.add('active');
        }
    });
});

/* ==========================================================================
   UI ANIMATIONS (Added safely to existing script)
   ========================================================================== */

document.addEventListener("DOMContentLoaded", () => {

    // 1. STATS COUNTER ANIMATION
    const statNumbers = document.querySelectorAll('.stat-number');
    let hasAnimated = false;

    // A function to animate a single number
    const animateValue = (obj, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            // Ease out effect
            const easeOutProgress = 1 - Math.pow(1 - progress, 3);
            obj.innerHTML = Math.floor(easeOutProgress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };

    // Observer to detect when Stats section is on screen
    const statsSection = document.getElementById('stats');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !hasAnimated) {
                hasAnimated = true;
                statNumbers.forEach(stat => {
                    const target = parseInt(stat.getAttribute('data-target'), 10);
                    // Animate over 2 seconds (2000ms)
                    animateValue(stat, 0, target, 2000);
                });
            }
        }, { threshold: 0.5 }); // Trigger when 50% of the stats section is visible

        observer.observe(statsSection);
    }

    // 2. FAQ ACCORDION ANIMATION
    const faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const currentFaqItem = question.parentElement;

            // Check if this item is already active
            const isActive = currentFaqItem.classList.contains('active');

            // Close all other FAQ items first for a clean look
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });

            // If it wasn't active before, open it
            if (!isActive) {
                currentFaqItem.classList.add('active');
            }
        });
    });

});