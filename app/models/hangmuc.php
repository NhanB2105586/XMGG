<?php

namespace App\Models;

use PDO;

class Hangmuc
{
    protected $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAllHangmucPages()
    {
        $sql = "SELECT * FROM hangmuc_pages ORDER BY id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHangmucPageBySlug($slug)
    {
        $sql = "SELECT * FROM hangmuc_pages WHERE slug = :slug";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getHangmucPageById($id)
    {
        $sql = "SELECT * FROM hangmuc_pages WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateHangmucPage($id, $title, $description, $content, $imagePath = null)
    {
        $sql = "UPDATE hangmuc_pages SET title = :title, description = :description, content = :content";
        $params = [
            ':id' => $id,
            ':title' => $title,
            ':description' => $description,
            ':content' => $content
        ];

        if ($imagePath) {
            $sql .= ", image_path = :image_path";
            $params[':image_path'] = $imagePath;
        }

        $sql .= ", updated_at = NOW() WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function createHangmucPage($slug, $title, $description, $content, $imagePath = null)
    {
        $sql = "INSERT INTO hangmuc_pages (slug, title, description, content, image_path, created_at, updated_at) 
                VALUES (:slug, :title, :description, :content, :image_path, NOW(), NOW())";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':slug' => $slug,
            ':title' => $title,
            ':description' => $description,
            ':content' => $content,
            ':image_path' => $imagePath
        ]);
    }

    public function createSampleData()
    {
        $sampleData = [
            [
                'slug' => 'tran',
                'title' => 'Những công trình mà Đại Quân đã thi công - Hạng mục Trần',
                'description' => 'Hệ trần sử dụng vật liệu xi măng giả gỗ mang lại cảm giác ấm áp và sang trọng',
                'content' => 'Hệ trần sử dụng vật liệu xi măng giả gỗ mang lại cảm giác ấm áp và sang trọng, bền vững với thời gian. Thiết kế hiện đại với các mẫu đa dạng phù hợp với mọi không gian nội thất. Trần xi măng giả gỗ không chỉ đẹp mà còn có độ bền cao, chống ẩm mốc và dễ bảo trì.',
                'image_path' => '/images/hangmuc/tran/tran1.JPG'
            ],
            [
                'slug' => 'lam',
                'title' => 'Những công trình mà Đại Quân đã thi công - Hạng mục Lam',
                'description' => 'Lam xi măng giả gỗ tạo không gian thoáng mát và thẩm mỹ cao',
                'content' => 'Lam xi măng giả gỗ là giải pháp lý tưởng cho không gian ngoài trời, tạo không gian thoáng mát và thẩm mỹ cao. Vật liệu xi măng giả gỗ đảm bảo độ bền cao, chống chịu tốt với thời tiết và môi trường khắc nghiệt.',
                'image_path' => '/images/hangmuc/lam/lam.JPG'
            ],
            [
                'slug' => 'san',
                'title' => 'Những công trình mà Đại Quân đã thi công - Hạng mục Sàn',
                'description' => 'Sàn xi măng giả gỗ mang lại vẻ đẹp tự nhiên và độ bền cao',
                'content' => 'Sàn xi măng giả gỗ mang lại vẻ đẹp tự nhiên và độ bền cao cho không gian sống. Với thiết kế đa dạng, sàn xi măng giả gỗ phù hợp với mọi phong cách nội thất từ cổ điển đến hiện đại.',
                'image_path' => '/images/hangmuc/san/san.jpg'
            ],
            [
                'slug' => 'vach',
                'title' => 'Những công trình mà Đại Quân đã thi công - Hạng mục Vách',
                'description' => 'Vách xi măng giả gỗ tạo không gian riêng tư và thẩm mỹ',
                'content' => 'Vách xi măng giả gỗ không chỉ tạo không gian riêng tư mà còn mang lại vẻ đẹp thẩm mỹ cao. Vật liệu xi măng giả gỗ đảm bảo độ bền và dễ bảo trì, phù hợp cho cả nội thất và ngoại thất.',
                'image_path' => '/images/hangmuc/vach/vach.JPG'
            ],
            [
                'slug' => 'cua',
                'title' => 'Những công trình mà Đại Quân đã thi công - Hạng mục Cửa',
                'description' => 'Cửa xi măng giả gỗ kết hợp giữa thẩm mỹ và chức năng',
                'content' => 'Cửa xi măng giả gỗ kết hợp hoàn hảo giữa thẩm mỹ và chức năng. Với thiết kế đa dạng, cửa xi măng giả gỗ phù hợp với mọi không gian và phong cách thiết kế.',
                'image_path' => '/images/hangmuc/cua/cua.png'
            ],
            [
                'slug' => 'cauthang',
                'title' => 'Những công trình mà Đại Quân đã thi công - Hạng mục Cầu thang',
                'description' => 'Cầu thang xi măng giả gỗ tạo điểm nhấn cho không gian',
                'content' => 'Cầu thang xi măng giả gỗ không chỉ mang lại vẻ đẹp tự nhiên mà còn tạo cảm giác ấm áp và thân thiện cho cả không gian nội thất lẫn ngoại thất. Với độ bền cao và thiết kế đa dạng.',
                'image_path' => '/images/hangmuc/cauthang/cauthang3.jpg'
            ],
            [
                'slug' => 'hangrao',
                'title' => 'Những công trình mà Đại Quân đã thi công - Hạng mục Hàng rào',
                'description' => 'Hàng rào xi măng giả gỗ bảo vệ và tạo thẩm mỹ cho công trình',
                'content' => 'Hàng rào xi măng giả gỗ là giải pháp lý tưởng cho không gian ngoài trời với độ bền cao, tạo sự riêng tư và an toàn cho công trình. Vật liệu xi măng giả gỗ chống chịu tốt với thời tiết.',
                'image_path' => '/images/hangmuc/hangrao/hg1.jpg'
            ],
            [
                'slug' => 'bonhoa',
                'title' => 'Những công trình mà Đại Quân đã thi công - Hạng mục Bồn hoa, bàn, ghế',
                'description' => 'Bồn hoa, bàn ghế xi măng giả gỗ cho không gian ngoài trời',
                'content' => 'Bồn hoa, bàn ghế xi măng giả gỗ là giải pháp lý tưởng cho không gian ngoài trời với độ bền cao, tạo không gian xanh và thân thiện. Vật liệu xi măng giả gỗ chống chịu tốt với môi trường.',
                'image_path' => '/images/hangmuc/bonhoa/banghe.png'
            ]
        ];

        $successCount = 0;
        foreach ($sampleData as $data) {
            if ($this->createHangmucPage($data['slug'], $data['title'], $data['description'], $data['content'], $data['image_path'])) {
                $successCount++;
            }
        }

        return $successCount;
    }

    public function checkTableExists()
    {
        $sql = "SHOW TABLES LIKE 'hangmuc_pages'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
