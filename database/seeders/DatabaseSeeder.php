<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private Category $category;
    private Publisher $publisher;
    /**
     * @var array<Author>
     */
    private array $authors = [];
    /**
     * @var array<Book>
     */
    private array $books = [];
    public function run(): void
    {
        $this->createAdmin();
        if (!app()->isProduction()) $this->createTestData();
    }
    private function createAdmin():void
    {
        User::create([
            'name' => config('app.admin.name'),
            'email' => config('app.admin.email'),
            'password' => Hash::make(config('app.admin.password')),
            'role' => RolesEnum::OWNER->value
        ]);
    }
    private function createTestData():void
    {
        $this->createCategory();
        $this->createPublisher();
        $this->createBooks();
        $this->createAuthors();
        $this->addAuthorsToBooks();
    }
    private function createCategory():void
    {
        $this->category = Category::create([
            'name' => 'برمجة',
            'description' => 'قسم خاصة بالبرمجة',
            'slug' => 'programming'
        ]);
        Category::insert([
            'name' => 'لا شيء',
            'description' => 'قسم إضافي تجريبي',
            'slug' => 'any'
        ]);
    }
    private function createPublisher():void
    {
        $this->publisher =  Publisher::create([
            'name'=>'أكادمية حاسوب',
            'address'=>'المملكة المتحدة',
        ]);
    }
    private function createBooks():void
    {

        $books = array_map($this->addCategoryAndPublisherToBook(...),$this->getBooks());
        foreach ($books as $book)
            $this->books[] = Book::create($book);
    }
    private function addCategoryAndPublisherToBook(array $book):array
    {
        $book['category_id'] = $this->category->id;
        $book['publisher_id'] = $this->publisher->id;
        return $book;
    }
    private function getBooks():array
    {
        $books = [];
        $books[] = [
            'title'=>'دليل المستقل والعامل عن بعد 1.2.0',
            'isbn'=>'111111111111111111',
            'description'=>'انتشر مصطلح العمل الحر في الآونة الأخير انتشار النار في الهشيم، وسبب ذلك جائحة كوفيد-19 التي ضربت العالم فقلبت الموازين، فالآن وبعد إلزام الدول للشعوب بالبقاء في المنازل وفرض قيود على نمط الحياة وحتى أسلوب العمل من أجل الحد من انتشار الوباء، تعرّف أغلب الناس طوعًا أو كرهًا إلى أسلوب العمل المستقل والعمل عن بعد من المنزل، واضطر كثير منهم إلى دخول سوق الإنترنت ليقدموا خدماتهم بشكل مستقل بعد إنهاء عقودهم مع شركاتهم بسبب تقليل الشركات لنفقاتها، وحتى الذي استمروا في عملهم ووظيفتهم اضطروا إلى تبني أسلوب العمل من المنزل إذ رأينا الكثير من الشركات التي أغلقت مقراتها ونقلها إلى أسلوب العمل عن بعد وهنا وجد الموظفون أنفسهم أمام نمط عمل غريب لم يعتادوه من قبل! ',
            'date_publish'=>'2021/4/22',
            'pages'=>'141',
            'copies'=>'100',
            'price'=>'5',
            'thumbnail'=>'https://academy.hsoub.com/uploads/monthly_2021_06/Freelancing-Remoat-Work-Guide-cover.png.8bc73da0e998f9af78d1e9a09e353c3c.png'
        ];
        $books[] = [
            'title'=>' دليل إدارة خواديم أوبنتو 1.0.0 ',
            'isbn'=>'222222222222',
            'description'=>'رافقت زيادة استخدام شبكة الإنترنت زيادةً كبيرةً في عدد الحواسيب التي تعمل مخدماتٍ لمختلف الخدمات الشائعة، كمواقع الويب والبريد الإلكتروني والمراسلة الفورية وخواديم الملفات وخلافه؛ وقد أثبت لينُكس تفوقه في مجال الخواديم، وخصوصًا بعد الانتشار الواسع لتوزيعة أوبنتو الخاصة بالخواديم؛ الذي يُعنى هذا الدليل بشرح طرق تثبيت وضبط مختلف خدماتها.',
            'date_publish'=>'2016/1/28',
            'pages'=>'631',
            'copies'=>'100',
            'price'=>'5',
            'thumbnail'=>'https://academy.hsoub.com/uploads/monthly_2016_01/01_497x497.png.e7207c4fa11fe48e5a2cf3357800419d.png'
        ];
        return $books;
    }

    private function createAuthors():void
    {
        foreach (['أكادمية حاسوب','شركة حاسوب'] as $author)
            $this->authors[] = Author::create([
                'name'=>$author,
                'description'=>"وصف {$author}",
                'image' => 'https://avatars.githubusercontent.com/u/12829424?s=200' // from github
            ]);
    }

    private function addAuthorsToBooks():void
    {
        $author_book = [];
        foreach ($this->books as $book)
            foreach ($this->authors as $author)
                $author_book[] = ['author_id'=>$author->id,'book_id'=>$book->id];
        DB::table('author_book')->insert($author_book);
    }
}
