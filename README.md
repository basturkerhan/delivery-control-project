# Delivery-Control (Sipariş Kontrol Sistemi) Projesi

## Hakkında
Hala bazı esnaf ve marketler, bu iş için internette veritabanları olmadığı için sattıkları eşyaların teslimini yapacakları yerlerin adreslerini ve içeriğini küçük kağıtlara veya post-it kağıtlara yazmaktadır. Bu kağıtlar boyutları sebebiyle kaybolduğu veya zarar gördüğü takdirde teslimatta sıkıntılar çıkabilmektedir. Ayrıca teslimi yapıldıktan sonra adres gibi özel bilgiler içeren bu kağıtların çöp kutularına atılması da risk teşkil etmektedir. Bunun dışında kağıt israfına da yol açılmaktadır. Kağıt israfının önüne geçmek için bilgisayar diskine yapılan kayıtlara ise dağıtım anında bilgisayarın yanda olmadığı durumlarda erişilmesi zor olmaktadır. Bu proje ile her türlü cihazdan erişilebilecek tamamen ücretsiz bir internet sitesi yapılarak bu sorunların önüne geçilmesi amaçlanmıştır.
<br>
<br>
Proje; CSS, Bootstrap kütüphanesi, HTML, PHP, Javascript ve jQuery kütüphanesi ile MySQL veritabanı kullanılarak Bilgisayar Mühendisliği 2. Sınıf Web Programlama dersi için hazırlanmıştır.
**Projenin demo adresine şu bağlantı aracılığıyla erişebilirsiniz: http://deliverycontrol.eu5.org/**

 ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/responsive.png)

<RESPONSIVE IMAGE>

## Kullanılan Teknolojiler
##### -HTML
##### -CSS
##### -JavaScript
##### -PHP
##### -Bootstrap5
##### -jQuery
##### -MySQL

## Proje Dizini

##### - **/assets** klasörü içinde, proje içinde kullanılan çeşitli fotoğraflar yer almaktadır.
##### - **/css** klasörü içinde projenin stil kodlarının yer aldığı dosya yer almaktadır.
##### - **/db** klasörü içinde veritabanı bağlantısını sağlayan dosya yer almaktadır.
##### - **/docs** klasörü içinde bootstrap kütüphanesi yer almaktadır.
##### - **/js** klasörü içinde jQuery kütüphanesi yer almaktadır.
##### - **/components** klasörü içinde tek php dosyasında uzun kod parçaları yazılıp modülerliği bozmamak için farklı dosyalara bölünen componentler yer almaktadır.
##### - **/app** klasörü bir nevi projenin API kısmı olarak çalışmaktadır. Ön yüzde yapılan işlemler ile bu klasör içindeki uygun dosyalara GET/POST sorguları gönderilerek veritabanı üzerinde işlemler yapılmaktadır.

## Veritabanı Hakkında

Proje veritabanı 4 adet tablodan oluşmaktadır;
<br>
"users" tablosu üyelik sistemi için oluşturulmuştur ve id, user_name, password, name alanlarını tutmaktadır. Şifre veritabanına kaydedilirken doğrudan değil, şifrelenerek kaydedilmektedir.
<br>
"deliveries" tablosu sipariş bilgisi kartları içindir. Bu tablo, aynı zamanda içerdiği user_ID alanı sayesinde "users" tablosu ile 1-n ilişkisi içindedir. Bunun dışında kartın başlığını, alt başlığını, tamamlanma bilgisini, oluşturulma tarihini de tutmaktadır.
<br>
"categories" tablosu da içerdiği user_ID alanı sayesinde "users" tablosu ile 1-n ilişkisi içindedir. Bunun dışında bir de ilgili kategori adını tutmaktadır.
<br>
"category_delivery" tablosu ise deliveries ve categories alanları arasında n-m ilişkisi kurmak için eklenmiştir. Teslimat kartına karşılık gelen kategorileri tutmaktadır. n-m ilişkisi sayesinde bir teslimat bilgisi kartı birden fazla kategoriye sahip olabilmektedir.
![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/sema.png)
  
## Projeyi Sunucuma/Yerel Bilgisayarıma Nasıl Kurabilirim?
Proje dosyalarının ana dizininde veya db klasörü altında db.sql isminde veritabanı dosyası yer almaktadır. Bu dosyayı PhpMyAdmin aracılığı ile sunucunuzun/yerel bilgisayarınızın veritabanına "İçe Aktar" seçeneği ile aktarınız. Ardından /db klasörü altında yer alan **db_conn.php** dosyasını açarak ayarları şu şekilde yapınız;
```
    $sName   = "";   // eğer yerel cihazınızda kullanacaksınız "localhost" olaral bırakabilirsiniz
    $uName   = "";   // veritabanı kullanıcı adınız (yerel cihazınızda muhtemelen "root" olacaktır)
    $pass    = "";   // veritabanı şifreniz (yerel cihazınızda sunucuyu xampp ile açtıysanız boş bırakabilirsiniz)
    $db_name = "";   // veritabanınızın ismi
```
Ayarları bu şekilde yaptıktan sonra artık sunucunuz başarıyla çalışacaktır. Eğer çalışan bir örneğini görmek isterseniz;
  **Projenin demo adresine şu bağlantı aracılığıyla erişebilirsiniz: http://deliverycontrol.eu5.org/**
  
## Projenin Özellikleri ve Kullanımı
  
### -Üyelik Sistemi:
  #### Proje üyelik sistemine sahiptir. Index sayfasının sağ üstünde yer alan Giriş Yap veya Kayıt Ol butonları ile gerekli işlemleri yapabilirsiniz.
### -Cihaz Uyumlu (Responsive) Tasarım:
  #### Projenin hakkında kısmında da belirtildiği üzere bu projeye hareket anında farklı cihazlardan düzgün bir şekilde ulaşabilmek çok önemlidir. Bu nedenle projenin tüm cihazlarda düzgün bir şekilde görüntülenebilmesi gerekmektedir. Çeşitli CSS kodları ve Bootstrap kütüphanesi kullanımı aracılığıyla bu özellik sağlanmıştır. 
### -Teslimat Kartları, Kategoriler ve Kullanım Hakkında:
  #### Uygulamaya giriş yaptıktan sonra sağ alt kısımda yuvarlak menü butonları görülecektir. Bu butonlardan;
  ##### -Göz işareti olan, menüyü gizle/göster özelliğidir. Mobil kullanımda menünün kartları silme ve düzenleme butonlarının üstüne geçip kullanımı zorlaştırmasını önlemek için eklenmiştir. 
  ##### -Kırmızı renkli etiket ikonuna sahip olan buton, eklenen bir kategoriyi menüden seçip silmek için kullanılabilmektedir.
  ##### -Mavi renkli etiket ikonuna sahip olan buton, kullanıcının kendina ait bir kategori eklemesi için kullanılabilmektedir.
  ##### -En alttaki "+" işaretli ikona sahip olan buton sayesindeyse yeni bir "Teslimat Bilgisi Kartı" eklenebilmektedir.
   ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/home-responsive.png)
  
  
 ### Teslimat Kartlarının Tasarımı Hakkında:
  Eklenebilecek ayarlarına göre farklı çeşitlerde Teslimat Kartları üretilebilir. Bu kartlar şu şekilde sınıflandırılabilir;
 
  
  
  #### 1- Kategorisi ve Alt Başlığı Olmayan Henüz Tamamlanmamış Teslimat Kartı
  ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/1.png)
  #### 2- Kategorisi ve Alt Başlığı Olmayan Tamamlanmış Teslimat Kartı
   ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/2.png)
  #### 3- Kategorisi Olmayan, Alt Başlığa Sahip ve Henüz Tamamlanmamış Teslimat Kartı
   ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/3.png)
  #### 4- Kategorisi Olmayan, Alt Başlığa Sahip ve Tamamlanmış Teslimat Kartı
   ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/4.png)
  #### 5- Alt Başlığı Olmayan, Kategoriye Sahip ve Henüz Tamamlanmamış Teslimat Kartı
   ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/7.png)
  #### 6- Alt Başlığı Olmayan, Kategoriye Sahip ve Tamamlanmış Teslimat Kartı
   ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/8.png)
  #### 7- Alt Başlığı Olan, Kategoriye Sahip ve Henüz Tamamlanmamış Teslimat Kartı
   ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/5.png)
  #### 8- Alt Başlığı Olan, Kategoriye Sahip ve Tamamlanmış Teslimat Kartı
   ![Screenshot](https://github.com/basturkerhan/delivery-control-project/blob/main/github_images/6.png)
  

 ### Yazar
 Erhan Baştürk
