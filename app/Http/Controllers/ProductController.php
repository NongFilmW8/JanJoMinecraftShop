<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    private $products = [
        ['id' => 1, 'name' => 'Normal ID',
         'description' => "✅ สามารถเปลี่ยนข้อมูลได้ทั้งหมด\n" .
                         "✅ ทางร้านขายยกเมล หมดกังวลเรื่องไอดีโดนดึงคืน\n" .
                         "✅ เป็นไอดีที่ Migrate เป็น Microsoft account แล้ว ซึ่งมีความปลอดภัยสูง\n" .
                         "✅ สามารถเปลี่ยนอีเมลได้ทันที (ขายยกเมล)\n" .
                         "✅ สามารถเข้าเล่นในเซิฟ HYPIXEL",
         'price' => 1500,
         'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321335987909165087/NormalID.png?ex=676d8648&is=676c34c8&hm=4108edb79301a9237d5594e6107260ad02eee933ff613192f4d0070345a2f904&=&format=webp&quality=lossless&width=936&height=936'],
        ['id' => 2, 'name' => 'Cape',
         'description' => "✅ สามารถเปลี่ยนข้อมูลได้ทั้งหมด\n" .
                         "✅ ทางร้านขายยกเมล หมดกังวลเรื่องไอดีโดนดึงคืน\n" .
                         "✅ เป็นไอดีที่ Migrate เป็น Microsoft account แล้ว ซึ่งมีความปลอดภัยสูง\n" .
                         "✅ สามารถเปลี่ยนอีเมลได้ทันที\n" .
                         "✅ สามารถเข้าเล่นในเซิฟ HYPIXEL\n" .
                         "✅ มีผ้าคลุม Vanila+Migrator สามารถมองเห็นได้โดยไม่ต้องลงมอด",
         'price' => 800,
         'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321340307937169440/LF75IBoGiLVBcVaYMQdSyQVU2wmZQRjI_-_VanillaMigrator.png?ex=676ce18e&is=676b900e&hm=65bfc6d1045c91b086cd0fecc2e065077050c406963b8b6a2d727a25c882a7e4&=&format=webp&quality=lossless&width=936&height=936'],

        ['id' => 3, 'name' => 'VanilaCape',
         'description' => "✅ สามารถเปลี่ยนข้อมูลได้ทั้งหมด\n" .
                         "✅ ทางร้านขายยกเมล หมดกังวลเรื่องไอดีโดนดึงคืน\n" .
                         "✅ เป็นไอดีที่ Migrate เป็น Microsoft account แล้ว ซึ่งมีความปลอดภัยสูง\n" .
                         "✅ สามารถเปลี่ยนอีเมลได้ทันที\n" .
                         "✅ สามารถเข้าเล่นในเซิฟ HYPIXEL\n" .
                         "✅ มีผ้าคลุม Vanila สามารถมองเห็นได้โดยไม่ต้องลงมอด",
         'price' => 500,
         'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321480452225237053/vanilacape.jpg?ex=676d6413&is=676c1293&hm=690d16273f1be95af6e708e27ff11eecff22b05f04027d56ac52dd00e3559520&=&format=webp&width=936&height=936'],

        ['id' => 4, 'name' => 'Diamond Sword',
         'description' => "✅ ดาบที่ทรงพลังที่สุดในเกม\n" .
                          "✅ ทำจากเพชรที่มีความทนทานสูง\n" .
                          "✅ สามารถทำลายศัตรูได้อย่างรวดเร็ว\n" .
                          "✅ มีความสามารถในการสร้างความเสียหายสูง\n" .
                          "✅ เหมาะสำหรับการต่อสู้กับมอนสเตอร์ที่แข็งแกร่ง\n" .
                          "✅ ดีไซน์สวยงามและมีเอกลักษณ์",
         'price' => 500,
         'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321485782401421384/Diamond_Sword.webp?ex=676d690a&is=676c178a&hm=19b691b3bae119bec2d79e879542cfcf8739a0cfb34a4e2022954c8fb101cc5f&=&format=webp&width=720&height=720'],

        ['id' => 5, 'name' => 'Iron Pickaxe',
         'description' => "✅ เหมาะสำหรับการขุดแร่ที่แข็งแรง\n" .
                          "✅ ทำจากเหล็กที่มีความทนทานสูง\n" .
                          "✅ สามารถขุดบล็อกได้รวดเร็ว\n" .
                          "✅ ใช้ในการขุดแร่ทองคำและเพชร\n" .
                          "✅ ดีไซน์ที่เรียบง่ายและมีประสิทธิภาพ\n" .
                          "✅ เป็นเครื่องมือที่จำเป็นสำหรับนักสำรวจ",
         'price' => 300,
         'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321488657009475614/Iron_Pickaxe.webp?ex=676d6bb7&is=676c1a37&hm=284d659613c297659e6ccdf7e1aef754e82bda639c9e2e6e6e9fe46f88c46b1c&=&format=webp&width=720&height=720'],

        ['id' => 6, 'name' => 'Netherite Axe',
         'description' => "✅ ด้ามจับทำจากเนเธอไรต์ที่มีความทนทานสูง\n" .
                          "✅ สามารถทำลายบล็อกได้รวดเร็ว\n" .
                          "✅ เหมาะสำหรับการตัดไม้และการทำฟาร์ม\n" .
                          "✅ มีความสามารถในการสร้างความเสียหายสูง\n" .
                          "✅ ใช้ในการต่อสู้กับมอนสเตอร์ได้อย่างมีประสิทธิภาพ\n" .
                          "✅ ดีไซน์ที่สวยงามและมีเอกลักษณ์",
         'price' => 1200,
         'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321491281788014713/Netherite_Axe.webp?ex=676d6e29&is=676c1ca9&hm=ee852c838a00967b91d02acbd312561fffa060751474582ae85237b90a65d001&=&format=webp&width=720&height=720'],

        ['id' => 7, 'name' => 'Ender Pearl',
        'description' => 'A mysterious pearl that allows teleportation',
        'price' => 20.00,
        'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321494601873231902/Ender_Pearl.webp?ex=676d7141&is=676c1fc1&hm=ecdcb9ddaf11573f4c93b6a870377480468cf0b74cf3d16d4009f8a11ae58ad6&=&format=webp&width=320&height=320'],
        ['id' => 8, 'name' => 'Golden Apple',
        'description' => "✅ เพิ่มพลังชีวิตและฟื้นฟูสุขภาพ\n" .
                          "✅ มีประโยชน์ในการต่อสู้กับมอนสเตอร์\n" .
                          "✅ ใช้ในการสร้างไอเทมพิเศษ\n" .
                          "✅ เป็นอาหารที่มีคุณค่าทางโภชนาการสูง",
        'price' => 100,
        'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321490098411274240/Golden_Apple.webp?ex=676d6d0f&is=676c1b8f&hm=a828e726f2a4e04a0e7555a7cda64f0eeb8de03033d84e333319537c2b0e6193&=&format=webp&width=320&height=320'],
        ['id' => 9, 'name' => 'Eye of Ender',
        'description' => "✅ ใช้ในการค้นหา Stronghold\n" .
                         "✅ ช่วยในการเปิด Portal ไปยัง The End\n" .
                         "✅ สามารถใช้ในการต่อสู้กับ Ender Dragon\n" .
                         "✅ มีความสำคัญในการสำรวจโลก Minecraft\n" .
                         "✅ ทำจาก Ender Pearl และ Blaze Powder",
        'price' => 200,
        'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321497232264003624/Eye_of_Ender.webp?ex=676d73b4&is=676c2234&hm=81e326e73b6d24cbbae98e46076f91dd83ff96de7a1ef4fe19601607c244a750&=&format=webp&width=320&height=320'],
        ['id' => 10, 'name' => 'Bow',
        'description' => 'A ranged weapon for attacking enemies',
        'price' => 30.00,
        'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321501215963484221/Bow.webp?ex=676d776a&is=676c25ea&hm=26e41b2dcc4905b7ea6defaaa0c7343f311526805ce6491e80c016797ed25452&=&format=webp&width=700&height=700'],
        ['id' => 11, 'name' => 'Fishing Rod',
        'description' => 'Used for fishing in water',
        'price' => 10.00,
        'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321501923840491572/Fishing_Rod.webp?ex=676d7812&is=676c2692&hm=7e7e181bce25a097b0b6b7b99d9fe475c13cfee0f5f5840bbf0dc4b1ba645cb6&=&format=webp&width=720&height=720'],
        ['id' => 12, 'name' => 'Mace',
        'description' => 'The mace is a slow melee weapon crafted with a breeze rod and a heavy core that is used to deal damage to entities, along with its unique new damage mechanic.',
        'price' => 25.00,
        'image' => 'https://media.discordapp.net/attachments/1321335591836717107/1321502704459059352/Mace.webp?ex=676d78cd&is=676c274d&hm=e2caaf7405a50c61edb079a729d8ee6326b0a7e193f73cfc57672f13dea835cb&=&format=webp&width=600&height=600'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Products/Index', ['products' => $this->products]);
    }


    //ส้างหน้า create
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     *///เพิ่มรูปใน create
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);
        if (!$product) {
            abort(404, 'Product not found');
        }
        return Inertia::render('Products/Show', ['product' => $product]);
    }
    public function buy($id)
    {
        $product = Product::findOrFail($id);
        // เพิ่ม logic สำหรับการซื้อสินค้า เช่น การชำระเงิน หรือการบันทึกการซื้อ
        return redirect()->route('products.index')->with('success', 'You have successfully purchased ' . $product->name);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
