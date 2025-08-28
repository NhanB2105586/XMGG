// Chatbot Tư vấn chuyên nghiệp XMGG - Version 3.0
// Cập nhật: Thông tin đầy đủ về XMGG + Giá chi tiết + Link sản phẩm
class Chatbot {
    constructor() {
        this.isOpen = false;
        this.messages = [];
        this.currentStep = 0;
        this.userInfo = {};
        this.websiteInfo = {
            company: {
                name: "CÔNG TY TNHH GIẢI PHÁP XÂY DỰNG VÀ THƯƠNG MẠI ĐẠI QUÂN",
                website: "ximanggiago.vn",
                email: "daiquandecor@gmail.com"
            },
            locations: {
                cantho: {
                    name: "SHOWROOM CẦN THƠ",
                    address: "I6-8 Cao Minh Lộc, Phường Hưng Phú, Tp.Cần Thơ",
                    phone: "093 949 64 69"
                },
                kiengiang: {
                    name: "VĂN PHÒNG KIÊN GIANG", 
                    address: "621A Nguyễn Trung Trực, Phường An Hòa, An Giang",
                    phone: "093 930 39 78"
                }
            },
            workingHours: {
                weekdays: "Thứ 2 - Thứ 7: 8:00 - 18:00",
                sunday: "Chủ nhật: 9:00 - 16:00"
            },
            products: {
                ximang: [
                    { name: "Thanh Lath", price: "150.000 - 250.000đ/m²", link: "/thanhlath" },
                    { name: "Thanh Lapsiding", price: "180.000 - 300.000đ/m²", link: "/lapsiding" },
                    { name: "Thanh Array", price: "200.000 - 350.000đ/m²", link: "/array" },
                    { name: "Thanh Deck", price: "250.000 - 400.000đ/m²", link: "/deck" },
                    { name: "Thanh Mould", price: "300.000 - 500.000đ/m²", link: "/mould" },
                    { name: "Thanh Plank", price: "220.000 - 380.000đ/m²", link: "/plank" },
                    { name: "Trần", price: "180.000 - 320.000đ/m²", link: "/tran" },
                    { name: "Lam", price: "160.000 - 280.000đ/m²", link: "/lam" },
                    { name: "Sàn", price: "200.000 - 350.000đ/m²", link: "/san" },
                    { name: "Vách", price: "180.000 - 300.000đ/m²", link: "/vach" },
                    { name: "Cửa", price: "1.500.000 - 3.500.000đ/cái", link: "/cua" },
                    { name: "Cầu thang", price: "2.500.000 - 5.000.000đ/bộ", link: "/cauthang" },
                    { name: "Hàng rào", price: "800.000 - 1.500.000đ/m", link: "/hangrao" },
                    { name: "Bồn hoa, bàn ghế", price: "500.000 - 1.200.000đ/bộ", link: "/bonhoa" }
                ],
                noithat: [
                    { name: "Sofa 1 chỗ", price: "2.500.000 - 4.500.000đ", link: "/sofa" },
                    { name: "Sofa 2 chỗ", price: "4.500.000 - 7.500.000đ", link: "/sofa" },
                    { name: "Sofa 3 chỗ", price: "6.500.000 - 12.000.000đ", link: "/sofa" },
                    { name: "Sofa góc L", price: "8.500.000 - 15.000.000đ", link: "/sofa" },
                    { name: "Bàn trà", price: "1.200.000 - 3.500.000đ", link: "/bannuoc" },
                    { name: "Tủ TV", price: "2.500.000 - 6.000.000đ", link: "/tutivi" },
                    { name: "Giường ngủ", price: "3.500.000 - 8.000.000đ", link: "/giuongngu" },
                    { name: "Tủ quần áo", price: "4.500.000 - 12.000.000đ", link: "/tuao" },
                    { name: "Bàn ăn 4 người", price: "2.500.000 - 5.500.000đ", link: "/banan" },
                    { name: "Bàn ăn 6 người", price: "3.500.000 - 7.500.000đ", link: "/banan" },
                    { name: "Bàn ăn 8 người", price: "5.500.000 - 12.000.000đ", link: "/banan" },
                    { name: "Ghế ăn", price: "800.000 - 1.800.000đ/ghế", link: "/ghean" },
                    { name: "Bàn làm việc", price: "1.800.000 - 4.500.000đ", link: "/banlamviec" },
                    { name: "Ghế văn phòng", price: "1.200.000 - 3.500.000đ", link: "/ghelamviec" },
                    { name: "Tủ bếp", price: "3.500.000 - 15.000.000đ", link: "/tubep" },
                    { name: "Tủ ly", price: "1.500.000 - 4.500.000đ", link: "/tuly" },
                    { name: "Nệm cao su", price: "2.500.000 - 8.000.000đ", link: "/nem" },
                    { name: "Gối, mền", price: "300.000 - 1.200.000đ", link: "/goimem" }
                ]
            },
            services: [
                "Tư vấn thiết kế nội thất",
                "Sản xuất nội thất theo yêu cầu", 
                "Thi công xi măng giả gỗ",
                "Bảo hành và bảo trì",
                "Giao hàng và lắp đặt",
                "Trả góp 0% lãi suất"
            ],
            priceFactors: [
                "Kích thước sản phẩm",
                "Chất liệu sử dụng", 
                "Độ phức tạp thiết kế",
                "Số lượng đặt hàng",
                "Địa điểm thi công",
                "Thời gian giao hàng"
            ]
        };
        
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
                    <div class="chatbot-logo">
                        <img src="/images/logo2.jpg" alt="Đại Quân Logo" class="logo-image">
                        <div class="logo-text">
                            <div class="logo-title">ĐẠI QUÂN</div>
                            <div class="logo-subtitle">XI MĂNG GIẢ GỖ</div>
                        </div>
                    </div>
                    <div class="notification-badge">1</div>
                </button>
                
                <div class="chatbot-window" id="chatbotWindow">
                    <div class="chatbot-header">
                        <div class="header-content">
                            <div class="header-logo">
                                <img src="/images/logo2.jpg" alt="Đại Quân Logo" class="header-logo-image">
                                <div class="logo-text">
                                    <div class="logo-title">ĐẠI QUÂN</div>
                                    <div class="logo-subtitle">XI MĂNG GIẢ GỖ</div>
                                </div>
                            </div>
                            <div class="header-info">
                                <h3>🤖 Tư vấn viên XMGG</h3>
                                <div class="status">
                                    <div class="dot"></div>
                                    <span>Đang hoạt động</span>
                                </div>
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
            `Xin chào! 👋 Tôi là trợ lý tư vấn của ${this.websiteInfo.company.name}.
            
Tôi có thể giúp bạn:
🏠 Tư vấn sản phẩm nội thất và xi măng giả gỗ
💰 Báo giá chi tiết từng sản phẩm
🔗 Gửi link xem sản phẩm trực tiếp
🚚 Thông tin giao hàng và lắp đặt
📞 Liên hệ và đặt lịch hẹn
🔧 Dịch vụ bảo hành và bảo trì

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
            'Báo giá chi tiết',
            'Xem sản phẩm',
            'Liên hệ'
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
            case 'Báo giá chi tiết':
                this.handleDetailedPriceQuote();
                break;
            case 'Xem sản phẩm':
                this.handleViewProducts();
                break;
            case 'Liên hệ':
                this.handleContact();
                break;
        }
    }

    handleProductConsultation() {
        setTimeout(() => {
            this.addBotMessage(
                `🎯 **TƯ VẤN SẢN PHẨM ${this.websiteInfo.company.name}**

Chúng tôi chuyên cung cấp 2 nhóm sản phẩm chính:

🏗️ **XI MĂNG GIẢ GỖ:**
• Thanh Lath, Lapsiding, Array, Deck, Mould, Plank
• Trần, Lam, Sàn, Vách, Cửa, Cầu thang
• Hàng rào, Bồn hoa, bàn, ghế ngoại thất

🪑 **NỘI THẤT CAO CẤP:**
• Nội thất phòng khách (Sofa, bàn trà, tủ TV...)
• Nội thất phòng ngủ (Giường, tủ quần áo...)
• Nội thất phòng ăn (Bàn ghế ăn...)
• Nội thất văn phòng (Bàn làm việc, ghế...)

Bạn quan tâm đến sản phẩm nào? Tôi sẽ tư vấn chi tiết hơn! 🏠`
            );
            
            // Thêm quick actions cho sản phẩm
            setTimeout(() => {
                this.addProductQuickActions();
            }, 1000);
        }, 500);
    }

    addProductQuickActions() {
        const messagesContainer = document.getElementById('chatbotMessages');
        const actionsDiv = document.createElement('div');
        actionsDiv.className = 'quick-actions';
        
        const actions = [
            'Xi măng giả gỗ',
            'Nội thất',
            'Xem tất cả'
        ];
        
        actions.forEach(action => {
            const button = document.createElement('button');
            button.className = 'quick-action';
            button.textContent = action;
            button.addEventListener('click', () => this.handleProductTypeAction(action));
            actionsDiv.appendChild(button);
        });
        
        messagesContainer.appendChild(actionsDiv);
        this.scrollToBottom();
    }

    handleProductTypeAction(action) {
        this.addUserMessage(action);
        
        setTimeout(() => {
            if (action === 'Xi măng giả gỗ') {
                this.addBotMessage(
                    `🏗️ **XI MĂNG GIẢ GỖ XMGG**

Chúng tôi chuyên cung cấp các sản phẩm xi măng giả gỗ cao cấp:

📋 **DANH MỤC SẢN PHẨM:**
• Thanh Lath - Ốp tường, trần
• Thanh Lapsiding - Ốp tường ngoại thất
• Thanh Array - Ốp tường trang trí
• Thanh Deck - Sàn ngoại thất
• Thanh Mould - Ốp tường mỹ thuật
• Thanh Plank - Ốp tường, sàn

🏠 **HẠNG MỤC THI CÔNG:**
• Trần nhà xi măng giả gỗ
• Lam che nắng, trang trí
• Sàn xi măng giả gỗ
• Vách ngăn, tường ốp
• Cửa đi, cửa sổ
• Cầu thang, hàng rào
• Bồn hoa, bàn ghế ngoại thất

Bạn quan tâm hạng mục nào? Tôi sẽ tư vấn chi tiết! 🎨`
                );
                
                // Thêm quick actions cho xi măng giả gỗ
                setTimeout(() => {
                    this.addXimangQuickActions();
                }, 1000);
            } else if (action === 'Nội thất') {
                this.addBotMessage(
                    `🪑 **NỘI THẤT CAO CẤP XMGG**

Chúng tôi cung cấp đầy đủ nội thất cho mọi không gian:

🏠 **PHÒNG KHÁCH:**
• Sofa các loại (1-3 chỗ, góc L)
• Bàn trà, bàn nước
• Tủ TV, kệ trang trí
• Ghế đôn, ghế bành

🛏️ **PHÒNG NGỦ:**
• Giường ngủ các kích thước
• Tủ quần áo, tủ đầu giường
• Bàn trang điểm
• Nệm cao su, nệm bông ép

🍽️ **PHÒNG ĂN:**
• Bàn ghế ăn 4-8 người
• Tủ bếp, tủ ly
• Ghế ăn các loại

💼 **VĂN PHÒNG:**
• Bàn làm việc
• Ghế văn phòng
• Tủ hồ sơ, kệ sách

Bạn cần nội thất cho không gian nào? Tôi sẽ tư vấn cụ thể! 🏡`
                );
                
                // Thêm quick actions cho nội thất
                setTimeout(() => {
                    this.addNoithatQuickActions();
                }, 1000);
            } else {
                this.addBotMessage(
                    `📋 **TẤT CẢ SẢN PHẨM XMGG**

Chúng tôi cung cấp đầy đủ giải pháp nội thất và xi măng giả gỗ:

🏗️ **XI MĂNG GIẢ GỖ** (14 sản phẩm)
🏠 **NỘI THẤT** (20 sản phẩm)

**ƯU ĐIỂM:**
✅ Chất lượng cao, bền đẹp
✅ Thiết kế hiện đại, đa dạng
✅ Giá cả hợp lý
✅ Bảo hành 12 tháng
✅ Giao hàng toàn quốc
✅ Lắp đặt miễn phí

Bạn có thể:
• Xem sản phẩm tại website: ${this.websiteInfo.company.website}
• Gọi hotline để được tư vấn
• Đặt lịch hẹn xem mẫu tại showroom

Bạn cần hỗ trợ gì thêm? 😊`
                );
            }
        }, 500);
    }

    addXimangQuickActions() {
        const messagesContainer = document.getElementById('chatbotMessages');
        const actionsDiv = document.createElement('div');
        actionsDiv.className = 'quick-actions';
        
        const actions = [
            'Thanh Lath',
            'Thanh Lapsiding', 
            'Trần, Lam, Sàn',
            'Vách, Cửa',
            'Xem tất cả giá'
        ];
        
        actions.forEach(action => {
            const button = document.createElement('button');
            button.className = 'quick-action';
            button.textContent = action;
            button.addEventListener('click', () => this.handleXimangAction(action));
            actionsDiv.appendChild(button);
        });
        
        messagesContainer.appendChild(actionsDiv);
        this.scrollToBottom();
    }

    addNoithatQuickActions() {
        const messagesContainer = document.getElementById('chatbotMessages');
        const actionsDiv = document.createElement('div');
        actionsDiv.className = 'quick-actions';
        
        const actions = [
            'Sofa phòng khách',
            'Giường, tủ phòng ngủ',
            'Bàn ghế ăn',
            'Bàn làm việc',
            'Xem tất cả giá'
        ];
        
        actions.forEach(action => {
            const button = document.createElement('button');
            button.className = 'quick-action';
            button.textContent = action;
            button.addEventListener('click', () => this.handleNoithatAction(action));
            actionsDiv.appendChild(button);
        });
        
        messagesContainer.appendChild(actionsDiv);
        this.scrollToBottom();
    }

    handleXimangAction(action) {
        this.addUserMessage(action);
        
        setTimeout(() => {
            if (action === 'Thanh Lath') {
                this.showProductDetails('ximang', 'Thanh Lath');
            } else if (action === 'Thanh Lapsiding') {
                this.showProductDetails('ximang', 'Thanh Lapsiding');
            } else if (action === 'Trần, Lam, Sàn') {
                this.showMultipleProducts(['Trần', 'Lam', 'Sàn']);
            } else if (action === 'Vách, Cửa') {
                this.showMultipleProducts(['Vách', 'Cửa']);
            } else if (action === 'Xem tất cả giá') {
                this.showAllXimangPrices();
            }
        }, 500);
    }

    handleNoithatAction(action) {
        this.addUserMessage(action);
        
        setTimeout(() => {
            if (action === 'Sofa phòng khách') {
                this.showMultipleProducts(['Sofa 1 chỗ', 'Sofa 2 chỗ', 'Sofa 3 chỗ', 'Sofa góc L']);
            } else if (action === 'Giường, tủ phòng ngủ') {
                this.showMultipleProducts(['Giường ngủ', 'Tủ quần áo', 'Nệm cao su']);
            } else if (action === 'Bàn ghế ăn') {
                this.showMultipleProducts(['Bàn ăn 4 người', 'Bàn ăn 6 người', 'Bàn ăn 8 người', 'Ghế ăn']);
            } else if (action === 'Bàn làm việc') {
                this.showMultipleProducts(['Bàn làm việc', 'Ghế văn phòng']);
            } else if (action === 'Xem tất cả giá') {
                this.showAllNoithatPrices();
            }
        }, 500);
    }

    showProductDetails(category, productName) {
        const product = this.websiteInfo.products[category].find(p => p.name === productName);
        
        if (product) {
            this.addBotMessage(
                `📋 **${product.name.toUpperCase()}**

💰 **GIÁ THAM KHẢO:** ${product.price}

🔗 **XEM SẢN PHẨM:** <a href="${product.link}" target="_blank" style="color: #667eea; text-decoration: underline;">Click vào đây để xem chi tiết</a>

📞 **TƯ VẤN CHI TIẾT:**
• Hotline Cần Thơ: ${this.websiteInfo.locations.cantho.phone}
• Hotline Kiên Giang: ${this.websiteInfo.locations.kiengiang.phone}

💡 **LƯU Ý:** Giá trên chỉ là tham khảo, giá thực tế phụ thuộc vào kích thước và yêu cầu cụ thể.

Bạn có muốn tôi tư vấn thêm sản phẩm khác không? 😊`
            );
        }
    }

    showMultipleProducts(productNames) {
        let message = `📋 **DANH SÁCH SẢN PHẨM**\n\n`;
        
        productNames.forEach(name => {
            const ximangProduct = this.websiteInfo.products.ximang.find(p => p.name === name);
            const noithatProduct = this.websiteInfo.products.noithat.find(p => p.name === name);
            const product = ximangProduct || noithatProduct;
            
            if (product) {
                message += `• **${product.name}:** ${product.price}\n`;
                message += `  🔗 <a href="${product.link}" target="_blank" style="color: #667eea; text-decoration: underline;">Xem chi tiết</a>\n\n`;
            }
        });
        
        message += `📞 **TƯ VẤN:** ${this.websiteInfo.locations.cantho.phone}\n`;
        message += `💡 Giá tham khảo, có thể thay đổi theo yêu cầu cụ thể.`;
        
        this.addBotMessage(message);
    }

    showAllXimangPrices() {
        let message = `🏗️ **BẢNG GIÁ XI MĂNG GIẢ GỖ XMGG**\n\n`;
        
        this.websiteInfo.products.ximang.forEach(product => {
            message += `• **${product.name}:** ${product.price}\n`;
            message += `  🔗 <a href="${product.link}" target="_blank" style="color: #667eea; text-decoration: underline;">Xem chi tiết</a>\n\n`;
        });
        
        message += `📞 **TƯ VẤN CHI TIẾT:**\n`;
        message += `• Hotline Cần Thơ: ${this.websiteInfo.locations.cantho.phone}\n`;
        message += `• Hotline Kiên Giang: ${this.websiteInfo.locations.kiengiang.phone}\n\n`;
        message += `💡 **LƯU Ý:** Giá trên chỉ là tham khảo, giá thực tế phụ thuộc vào:\n`;
        this.websiteInfo.priceFactors.forEach(factor => {
            message += `• ${factor}\n`;
        });
        
        this.addBotMessage(message);
    }

    showAllNoithatPrices() {
        let message = `🪑 **BẢNG GIÁ NỘI THẤT XMGG**\n\n`;
        
        this.websiteInfo.products.noithat.forEach(product => {
            message += `• **${product.name}:** ${product.price}\n`;
            message += `  🔗 <a href="${product.link}" target="_blank" style="color: #667eea; text-decoration: underline;">Xem chi tiết</a>\n\n`;
        });
        
        message += `📞 **TƯ VẤN CHI TIẾT:**\n`;
        message += `• Hotline Cần Thơ: ${this.websiteInfo.locations.cantho.phone}\n`;
        message += `• Hotline Kiên Giang: ${this.websiteInfo.locations.kiengiang.phone}\n\n`;
        message += `💡 **LƯU Ý:** Giá trên chỉ là tham khảo, giá thực tế phụ thuộc vào:\n`;
        this.websiteInfo.priceFactors.forEach(factor => {
            message += `• ${factor}\n`;
        });
        
        this.addBotMessage(message);
    }

    handleDetailedPriceQuote() {
        setTimeout(() => {
            this.addBotMessage(
                `💰 **BÁO GIÁ CHI TIẾT XMGG**

Để báo giá chính xác nhất, vui lòng cho biết:

📋 **THÔNG TIN CẦN THIẾT:**
• Sản phẩm bạn quan tâm
• Kích thước mong muốn
• Số lượng cần mua
• Địa chỉ giao hàng
• Thời gian cần thi công

📞 **LIÊN HỆ BÁO GIÁ:**
• Hotline Cần Thơ: ${this.websiteInfo.locations.cantho.phone}
• Hotline Kiên Giang: ${this.websiteInfo.locations.kiengiang.phone}
• Email: ${this.websiteInfo.company.email}

💳 **PHƯƠNG THỨC THANH TOÁN:**
• Tiền mặt khi nhận hàng
• Chuyển khoản ngân hàng
• Trả góp 0% lãi suất (áp dụng)

Bạn muốn xem bảng giá sản phẩm nào? Tôi sẽ gửi link chi tiết! 💯`
            );
            
            // Thêm quick actions cho báo giá
            setTimeout(() => {
                this.addPriceQuickActions();
            }, 1000);
        }, 500);
    }

    addPriceQuickActions() {
        const messagesContainer = document.getElementById('chatbotMessages');
        const actionsDiv = document.createElement('div');
        actionsDiv.className = 'quick-actions';
        
        const actions = [
            'Bảng giá xi măng giả gỗ',
            'Bảng giá nội thất',
            'Tư vấn cụ thể'
        ];
        
        actions.forEach(action => {
            const button = document.createElement('button');
            button.className = 'quick-action';
            button.textContent = action;
            button.addEventListener('click', () => this.handlePriceAction(action));
            actionsDiv.appendChild(button);
        });
        
        messagesContainer.appendChild(actionsDiv);
        this.scrollToBottom();
    }

    handlePriceAction(action) {
        this.addUserMessage(action);
        
        setTimeout(() => {
            if (action === 'Bảng giá xi măng giả gỗ') {
                this.showAllXimangPrices();
            } else if (action === 'Bảng giá nội thất') {
                this.showAllNoithatPrices();
            } else if (action === 'Tư vấn cụ thể') {
                this.addBotMessage(
                    `🎯 **TƯ VẤN CỤ THỂ**

Để tư vấn chính xác nhất, hãy cho tôi biết:

🏠 **KHÔNG GIAN CẦN THIẾT KẾ:**
• Phòng khách, phòng ngủ, phòng ăn?
• Diện tích khoảng bao nhiêu m²?
• Phong cách thiết kế mong muốn?

💰 **NGÂN SÁCH:**
• Khoảng bao nhiêu triệu đồng?
• Ưu tiên chất lượng hay giá cả?

📅 **THỜI GIAN:**
• Khi nào cần hoàn thành?
• Có cần gấp không?

Tôi sẽ tư vấn giải pháp phù hợp nhất! 🎨`
                );
            }
        }, 500);
    }

    handleViewProducts() {
        setTimeout(() => {
            this.addBotMessage(
                `🔗 **XEM SẢN PHẨM TRỰC TIẾP**

Bạn có thể xem sản phẩm tại các link sau:

🏗️ **XI MĂNG GIẢ GỖ:**
• <a href="/thanhlath" target="_blank" style="color: #667eea; text-decoration: underline;">Thanh Lath</a>
• <a href="/lapsiding" target="_blank" style="color: #667eea; text-decoration: underline;">Thanh Lapsiding</a>
• <a href="/tran" target="_blank" style="color: #667eea; text-decoration: underline;">Trần</a>
• <a href="/lam" target="_blank" style="color: #667eea; text-decoration: underline;">Lam</a>
• <a href="/san" target="_blank" style="color: #667eea; text-decoration: underline;">Sàn</a>
• <a href="/vach" target="_blank" style="color: #667eea; text-decoration: underline;">Vách</a>

🪑 **NỘI THẤT:**
• <a href="/sofa" target="_blank" style="color: #667eea; text-decoration: underline;">Sofa</a>
• <a href="/giuongngu" target="_blank" style="color: #667eea; text-decoration: underline;">Giường ngủ</a>
• <a href="/banan" target="_blank" style="color: #667eea; text-decoration: underline;">Bàn ăn</a>
• <a href="/banlamviec" target="_blank" style="color: #667eea; text-decoration: underline;">Bàn làm việc</a>
• <a href="/tubep" target="_blank" style="color: #667eea; text-decoration: underline;">Tủ bếp</a>

🌐 **WEBSITE CHÍNH:** <a href="https://${this.websiteInfo.company.website}" target="_blank" style="color: #667eea; text-decoration: underline;">${this.websiteInfo.company.website}</a>

Bạn muốn xem sản phẩm nào? Tôi sẽ gửi link chi tiết! 🚀`
            );
        }, 500);
    }

    handleContact() {
        setTimeout(() => {
            const contactInfo = `
                📞 **THÔNG TIN LIÊN HỆ ${this.websiteInfo.company.name}**

🏢 **SHOWROOM CẦN THƠ:**
📍 ${this.websiteInfo.locations.cantho.address}
📞 Hotline: ${this.websiteInfo.locations.cantho.phone}

🏢 **VĂN PHÒNG KIÊN GIANG:**
📍 ${this.websiteInfo.locations.kiengiang.address}
📞 Hotline: ${this.websiteInfo.locations.kiengiang.phone}

📧 **EMAIL:** ${this.websiteInfo.company.email}
🌐 **WEBSITE:** ${this.websiteInfo.company.website}

⏰ **GIỜ LÀM VIỆC:**
• ${this.websiteInfo.workingHours.weekdays}
• ${this.websiteInfo.workingHours.sunday}

🚀 **MẠNG XÃ HỘI:**
• Facebook: daiquandecor.vn
• Zalo: ${this.websiteInfo.locations.cantho.phone}
• Messenger: daiquandecor

Bạn có thể liên hệ qua bất kỳ kênh nào trên đây! 🎯
            `;
            
            this.addBotMessage(contactInfo);
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
            // Xử lý các từ khóa chính
            if (lowerMessage.includes('giá') || lowerMessage.includes('bao nhiêu') || lowerMessage.includes('giá cả')) {
                this.handleDetailedPriceQuote();
            } else if (lowerMessage.includes('giao hàng') || lowerMessage.includes('vận chuyển') || lowerMessage.includes('ship')) {
                this.addBotMessage(
                    `🚚 **THÔNG TIN GIAO HÀNG XMGG**

📦 **PHẠM VI GIAO HÀNG:** Toàn quốc
⏰ **THỜI GIAN GIAO HÀNG:** 5-7 ngày sau khi xác nhận đơn
💰 **PHÍ VẬN CHUYỂN:** Miễn phí trong nội thành
🏠 **LẮP ĐẶT:** Miễn phí lắp đặt tại nhà
📋 **BẢO HÀNH:** 12 tháng chính hãng

**QUY TRÌNH GIAO HÀNG:**
1️⃣ Xác nhận đơn hàng
2️⃣ Sản xuất theo yêu cầu (5-7 ngày)
3️⃣ Thông báo giao hàng
4️⃣ Giao hàng và lắp đặt
5️⃣ Kiểm tra và ký nhận
6️⃣ Bảo hành và hậu mãi

Bạn ở khu vực nào? Tôi sẽ tư vấn chi tiết hơn! 🚀`
                );
            } else if (lowerMessage.includes('liên hệ') || lowerMessage.includes('số điện thoại') || lowerMessage.includes('hotline')) {
                this.handleContact();
            } else if (lowerMessage.includes('xi măng') || lowerMessage.includes('giả gỗ')) {
                this.addBotMessage(
                    `🏗️ **XI MĂNG GIẢ GỖ XMGG**

Xi măng giả gỗ là vật liệu cao cấp với nhiều ưu điểm:

✅ **ƯU ĐIỂM:**
• Bền đẹp, chống ẩm mốc
• Dễ bảo trì, vệ sinh
• Thiết kế đa dạng
• Giá cả hợp lý
• Thân thiện môi trường

🏠 **ỨNG DỤNG:**
• Ốp tường nội ngoại thất
• Làm trần, sàn
• Cầu thang, hàng rào
• Bồn hoa, bàn ghế ngoại thất

📞 **TƯ VẤN CHI TIẾT:**
Hotline Cần Thơ: ${this.websiteInfo.locations.cantho.phone}
Hotline Kiên Giang: ${this.websiteInfo.locations.kiengiang.phone}

Bạn muốn tư vấn hạng mục nào? 🎨`
                );
            } else if (lowerMessage.includes('nội thất') || lowerMessage.includes('đồ gỗ')) {
                this.addBotMessage(
                    `🪑 **NỘI THẤT CAO CẤP XMGG**

Chúng tôi chuyên sản xuất nội thất chất lượng cao:

🏠 **PHÒNG KHÁCH:** Sofa, bàn trà, tủ TV, kệ trang trí
🛏️ **PHÒNG NGỦ:** Giường, tủ quần áo, bàn trang điểm
🍽️ **PHÒNG ĂN:** Bàn ghế ăn, tủ bếp, tủ ly
💼 **VĂN PHÒNG:** Bàn làm việc, ghế văn phòng

✅ **CHẤT LƯỢNG:**
• Gỗ tự nhiên cao cấp
• Thiết kế hiện đại
• Sơn PU cao cấp
• Bảo hành 12 tháng

📞 **TƯ VẤN:**
Hotline: ${this.websiteInfo.locations.cantho.phone}
Email: ${this.websiteInfo.company.email}

Bạn cần nội thất cho không gian nào? 🏡`
                );
            } else if (lowerMessage.includes('bảo hành') || lowerMessage.includes('bảo trì')) {
                this.addBotMessage(
                    `🔧 **CHÍNH SÁCH BẢO HÀNH XMGG**

✅ **THỜI GIAN BẢO HÀNH:** 12 tháng chính hãng

📋 **PHẠM VI BẢO HÀNH:**
• Lỗi sản xuất
• Hư hỏng do chất lượng
• Sơn phủ, keo dán
• Phụ kiện đi kèm

🚫 **KHÔNG BẢO HÀNH:**
• Hư hỏng do sử dụng sai cách
• Thiên tai, hỏa hoạn
• Va đập, trầy xước do người dùng

📞 **LIÊN HỆ BẢO HÀNH:**
• Hotline: ${this.websiteInfo.locations.cantho.phone}
• Email: ${this.websiteInfo.company.email}
• Địa chỉ: ${this.websiteInfo.locations.cantho.address}

Bạn cần hỗ trợ bảo hành gì? 🔧`
                );
            } else if (lowerMessage.includes('cảm ơn') || lowerMessage.includes('tạm biệt') || lowerMessage.includes('bye')) {
                this.addBotMessage(
                    `😊 Cảm ơn bạn đã sử dụng dịch vụ tư vấn của ${this.websiteInfo.company.name}!

Nếu cần hỗ trợ thêm, đừng ngần ngại liên hệ:
📞 Hotline Cần Thơ: ${this.websiteInfo.locations.cantho.phone}
📞 Hotline Kiên Giang: ${this.websiteInfo.locations.kiengiang.phone}

Chúc bạn một ngày tốt lành! 🌟`
                );
            } else {
                this.addBotMessage(
                    `🤔 Tôi hiểu bạn đang hỏi về "${message}"

Để tư vấn chính xác hơn, bạn có thể:
• Chọn một trong các tùy chọn bên dưới
• Gọi trực tiếp hotline Cần Thơ: ${this.websiteInfo.locations.cantho.phone}
• Gọi trực tiếp hotline Kiên Giang: ${this.websiteInfo.locations.kiengiang.phone}
• Email: ${this.websiteInfo.company.email}

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
