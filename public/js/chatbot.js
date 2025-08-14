// Chatbot Tư vấn chuyên nghiệp
class Chatbot {
    constructor() {
        this.isOpen = false;
        this.messages = [];
        this.currentStep = 0;
        this.userInfo = {};
        
        this.init();
        this.loadInitialMessages();
    }

    init() {
        this.createChatbotHTML();
        this.bindEvents();
        this.showNotification();
    }

    createChatbotHTML() {
        const chatbotHTML = `
            <div class="chatbot-container">
                <button class="chatbot-toggle" id="chatbotToggle">
                    <i class="fas fa-comments"></i>
                    <div class="notification-badge">1</div>
                </button>
                
                <div class="chatbot-window" id="chatbotWindow">
                    <div class="chatbot-header">
                        <div>
                            <h3>🤖 Tư vấn viên XMGG</h3>
                            <div class="status">
                                <div class="dot"></div>
                                <span>Đang hoạt động</span>
                            </div>
                        </div>
                        <button class="chatbot-close" id="chatbotClose">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="chatbot-messages" id="chatbotMessages">
                        <!-- Messages will be added here -->
                    </div>
                    
                    <div class="chatbot-input">
                        <input type="text" id="chatbotInput" placeholder="Nhập tin nhắn của bạn...">
                        <button id="chatbotSend">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', chatbotHTML);
    }

    bindEvents() {
        const toggle = document.getElementById('chatbotToggle');
        const close = document.getElementById('chatbotClose');
        const input = document.getElementById('chatbotInput');
        const send = document.getElementById('chatbotSend');

        toggle.addEventListener('click', () => this.toggleChatbot());
        close.addEventListener('click', () => this.closeChatbot());
        
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.sendMessage();
            }
        });
        
        send.addEventListener('click', () => this.sendMessage());
    }

    toggleChatbot() {
        const window = document.getElementById('chatbotWindow');
        const toggle = document.getElementById('chatbotToggle');
        const badge = toggle.querySelector('.notification-badge');
        
        if (this.isOpen) {
            this.closeChatbot();
        } else {
            this.openChatbot();
            if (badge) {
                badge.style.display = 'none';
            }
        }
    }

    openChatbot() {
        const window = document.getElementById('chatbotWindow');
        window.style.display = 'flex';
        this.isOpen = true;
        
        // Focus input
        setTimeout(() => {
            document.getElementById('chatbotInput').focus();
        }, 300);
    }

    closeChatbot() {
        const window = document.getElementById('chatbotWindow');
        window.style.display = 'none';
        this.isOpen = false;
    }

    showNotification() {
        // Hiển thị thông báo sau 3 giây
        setTimeout(() => {
            const badge = document.querySelector('.notification-badge');
            if (badge && !this.isOpen) {
                badge.style.display = 'flex';
            }
        }, 3000);
    }

    loadInitialMessages() {
        // Tin nhắn chào mừng
        this.addBotMessage(
            `Xin chào! 👋 Tôi là trợ lý tư vấn của XMGG. 
            
Tôi có thể giúp bạn:
• Tư vấn sản phẩm nội thất
• Hướng dẫn đặt hàng
• Thông tin liên hệ
• Giải đáp thắc mắc

Bạn cần tư vấn gì ạ? 😊`
        );

        // Quick actions
        setTimeout(() => {
            this.addQuickActions();
        }, 1000);
    }

    addBotMessage(text) {
        const messagesContainer = document.getElementById('chatbotMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message bot';
        
        const time = new Date().toLocaleTimeString('vi-VN', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        messageDiv.innerHTML = `
            <div class="message-content">
                ${text.replace(/\n/g, '<br>')}
            </div>
        `;
        
        messagesContainer.appendChild(messageDiv);
        this.scrollToBottom();
    }

    addUserMessage(text) {
        const messagesContainer = document.getElementById('chatbotMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message user';
        
        const time = new Date().toLocaleTimeString('vi-VN', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        messageDiv.innerHTML = `
            <div class="message-content">
                ${text}
            </div>
        `;
        
        messagesContainer.appendChild(messageDiv);
        this.scrollToBottom();
    }

    addQuickActions() {
        const messagesContainer = document.getElementById('chatbotMessages');
        const actionsDiv = document.createElement('div');
        actionsDiv.className = 'quick-actions';
        
        const actions = [
            'Tư vấn sản phẩm',
            'Báo giá',
            'Liên hệ',
            'Hướng dẫn mua hàng'
        ];
        
        actions.forEach(action => {
            const button = document.createElement('button');
            button.className = 'quick-action';
            button.textContent = action;
            button.addEventListener('click', () => this.handleQuickAction(action));
            actionsDiv.appendChild(button);
        });
        
        messagesContainer.appendChild(actionsDiv);
        this.scrollToBottom();
    }

    handleQuickAction(action) {
        this.addUserMessage(action);
        
        switch(action) {
            case 'Tư vấn sản phẩm':
                this.handleProductConsultation();
                break;
            case 'Báo giá':
                this.handlePriceQuote();
                break;
            case 'Liên hệ':
                this.handleContact();
                break;
            case 'Hướng dẫn mua hàng':
                this.handlePurchaseGuide();
                break;
        }
    }

    handleProductConsultation() {
        setTimeout(() => {
            this.addBotMessage(
                `🎯 Tư vấn sản phẩm nội thất XMGG

Chúng tôi chuyên cung cấp:
• Nội thất phòng khách (Sofa, bàn trà, tủ TV...)
• Nội thất phòng ngủ (Giường, tủ quần áo...)
• Nội thất phòng ăn (Bàn ghế ăn...)
• Nội thất văn phòng (Bàn làm việc, ghế...)

Bạn quan tâm đến sản phẩm nào? Tôi sẽ tư vấn chi tiết hơn! 🏠`
            );
        }, 500);
    }

    handlePriceQuote() {
        setTimeout(() => {
            this.addBotMessage(
                `💰 Báo giá sản phẩm

Để báo giá chính xác, vui lòng cho biết:
• Sản phẩm bạn quan tâm
• Kích thước mong muốn
• Số lượng cần mua
• Địa chỉ giao hàng

Hoặc bạn có thể gọi trực tiếp:
📞 Hotline Cần Thơ: 093 949 64 69
📞 Hotline Kiên Giang: 093 930 39 78

Tôi sẽ hỗ trợ báo giá nhanh chóng! 💯`
            );
        }, 500);
    }

    handleContact() {
        setTimeout(() => {
            const contactInfo = `
                📞 Thông tin liên hệ XMGG

🏢 SHOWROOM CẦN THƠ:
I6-8 Cao Minh Lộc, Phường Hưng Phú, Tp.Cần Thơ
📞 Hotline: 093 949 64 69

🏢 VĂN PHÒNG KIÊN GIANG:
621A Nguyễn Trung Trực, Phường An Hòa, An Giang
📞 Hotline: 093 930 39 78

📧 Email: daiquandecor@gmail.com
🌐 Website: ximanggiago.vn

⏰ Giờ làm việc:
• Thứ 2 - Thứ 7: 8:00 - 18:00
• Chủ nhật: 9:00 - 16:00

Bạn có thể liên hệ qua bất kỳ kênh nào trên đây! 🚀
            `;
            
            this.addBotMessage(contactInfo);
        }, 500);
    }

    handlePurchaseGuide() {
        setTimeout(() => {
            this.addBotMessage(
                `🛒 Hướng dẫn mua hàng

📋 Quy trình mua hàng:
1️⃣ Chọn sản phẩm yêu thích
2️⃣ Liên hệ tư vấn (qua chat này hoặc hotline)
3️⃣ Xác nhận đơn hàng và thanh toán
4️⃣ Sản xuất theo yêu cầu (5-7 ngày)
5️⃣ Giao hàng và lắp đặt
6️⃣ Bảo hành và hậu mãi

💳 Phương thức thanh toán:
• Tiền mặt khi nhận hàng
• Chuyển khoản ngân hàng
• Trả góp 0% lãi suất

Bạn cần hỗ trợ thêm gì không? 😊`
            );
        }, 500);
    }

    sendMessage() {
        const input = document.getElementById('chatbotInput');
        const message = input.value.trim();
        
        if (message) {
            this.addUserMessage(message);
            input.value = '';
            
            // Xử lý tin nhắn của user
            this.processUserMessage(message);
        }
    }

    processUserMessage(message) {
        const lowerMessage = message.toLowerCase();
        
        setTimeout(() => {
            if (lowerMessage.includes('giá') || lowerMessage.includes('bao nhiêu')) {
                this.addBotMessage(
                    `💰 Về giá sản phẩm:

Giá sản phẩm phụ thuộc vào:
• Loại sản phẩm
• Kích thước
• Chất liệu
• Số lượng

Để báo giá chính xác, vui lòng cho biết sản phẩm cụ thể bạn quan tâm hoặc gọi hotline Cần Thơ: 093 949 64 69

Tôi sẽ hỗ trợ báo giá nhanh chóng! 💯`
                );
            } else if (lowerMessage.includes('giao hàng') || lowerMessage.includes('vận chuyển')) {
                this.addBotMessage(
                    `🚚 Thông tin giao hàng:

📦 Phạm vi giao hàng: Toàn quốc
⏰ Thời gian giao hàng: 5-7 ngày sau khi xác nhận đơn
💰 Phí vận chuyển: Miễn phí trong nội thành
🏠 Lắp đặt: Miễn phí lắp đặt tại nhà
📋 Bảo hành: 12 tháng chính hãng

Bạn ở khu vực nào? Tôi sẽ tư vấn chi tiết hơn! 🚀`
                );
            } else if (lowerMessage.includes('liên hệ') || lowerMessage.includes('số điện thoại')) {
                this.handleContact();
            } else if (lowerMessage.includes('cảm ơn') || lowerMessage.includes('tạm biệt')) {
                this.addBotMessage(
                    `😊 Cảm ơn bạn đã sử dụng dịch vụ tư vấn của XMGG!

Nếu cần hỗ trợ thêm, đừng ngần ngại liên hệ:
📞 Hotline Cần Thơ: 093 949 64 69
📞 Hotline Kiên Giang: 093 930 39 78

Chúc bạn một ngày tốt lành! 🌟`
                );
            } else {
                this.addBotMessage(
                    `🤔 Tôi hiểu bạn đang hỏi về "${message}"

Để tư vấn chính xác hơn, bạn có thể:
• Chọn một trong các tùy chọn bên dưới
• Gọi trực tiếp hotline Cần Thơ: 093 949 64 69
• Gọi trực tiếp hotline Kiên Giang: 093 930 39 78

Tôi luôn sẵn sàng hỗ trợ bạn! 😊`
                );
                
                // Thêm lại quick actions
                setTimeout(() => {
                    this.addQuickActions();
                }, 1000);
            }
        }, 1000);
    }

    scrollToBottom() {
        const messagesContainer = document.getElementById('chatbotMessages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}

// Khởi tạo chatbot khi trang web load xong
document.addEventListener('DOMContentLoaded', function() {
    new Chatbot();
});
