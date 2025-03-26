# Bootstrap 5 Navwalker Menu

Bu proje, WordPress temaları için Bootstrap 5 uyumlu navigasyon menüsü oluşturmayı sağlayan özel bir navwalker sınıfıdır. WordPress'in `wp_nav_menu()` fonksiyonu ile oluşturulan menü çıktısını, Bootstrap 5'in dropdown, alt menüler ve responsive navbar yapısına uygun hale getirir.

## Özellikler

- **Bootstrap 5 Uyumluluğu:** Menü öğeleri Bootstrap 5 sınıflarıyla biçimlendirilir.
- **Çok Seviyeli Menü Desteği:** Dropdown ve dropdown-submenu gibi çok seviyeli alt menüler oluşturulabilir.
- **Kolay Entegrasyon:** WordPress `wp_nav_menu()` fonksiyonu ile entegre çalışır, böylece temanızda dinamik menü yapısı oluşturabilirsiniz.

## Kurulum

1. Bu repository'i klonlayın veya ZIP olarak indirin.
2. `class-wp-bootstrap-navwalker.php` dosyasını temanızın uygun bir dizinine (örneğin, `inc/` veya `includes/`) kopyalayın.
3. Temanızın `functions.php` dosyasına aşağıdaki kodu ekleyerek navwalker sınıfını dahil edin:

   ```php
   require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
