<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Modern CEO Office',
                'slug' => 'modern-ceo-office',
                'description' => "This sophisticated executive office embodies elegance and professionalism, making it an inspiring space for productivity and client interactions. The design is centered around luxurious finishes, including marble-textured accent walls complemented by gold trims that enhance the sense of opulence.\r\nThe workspace features a sleek wooden desk with ergonomic seating, ensuring both style and comfort. Adjacent to the workstation, a cozy seating area with a modern sectional sofa and marble-topped coffee tables offers an inviting space for informal meetings or relaxation.\r\nThoughtfully placed greenery adds a refreshing natural element, balancing the room's rich materials with a touch of vitality. Soft, ambient lighting and reflective black flooring further amplify the modern, upscale ambiance.\r\nThis design is a testament to the harmonious blend of functionality and luxury, tailored for the modern professional seeking a standout workspace.",
                'location' => 'United State of America',
                'year' => '2024',
                'type' => 'Sustainable Office',
                'category' => 'commercial',
                'main_image' => 'projects/1gj2i8TBS4a1OwIYfM1GB2sTkN3EUvs9Ui2c872c.png',
                'gallery_images' => json_encode(["projects/gallery/gMPKONcOpzdRI0fuJYzRs3dcjZpzqMmW57C5iCAc.png","projects/gallery/OdLSeTOjtQ6ISJZoOg1RCoInchfjffdxgZELG6NM.png","projects/gallery/gwIIL6nHH9ZtIbP5cs7X5Sw7MoKJqVAP5oAu9T79.png","projects/gallery/CEcwgPFq99os0pLrLrkWjl0xyq7npvThYh4tvdtM.png","projects/gallery/14M42ZvXEmhkw1EXxf236JkT48N0bFmC9S4SLBJx.png"]),
                'video_url' => 'https://www.youtube.com/watch?v=_exQQ1iDjzA',
                'features' => <<<'JSON'
[{"title":"Opulent Marble Accents","description":"Swirling beige and gold-veined marble walls gleam with luxurious depth, their cool, polished surface reflecting ambient light and infusing the space with a subtle, mineral-fresh scent, evoking timeless elegance amid a palette of warm taupes, creamy whites, and shimmering metallics.","icon":"sun"},{"title":"Ergonomic Executive Desk","description":"A sleek walnut desk anchors the workspace, its smooth wood grain warm under fingertips and carrying a faint, oaky aroma, paired with plush leather chairs that yield softly with a rich, buttery creak, set against a harmonious scheme of deep browns, soft grays, and gilded highlights.","icon":"laptop"},{"title":"Ambient LED Illumination","description":"Recessed ceiling strips and spotlights cast a golden, diffused glow that dances across surfaces, humming faintly like a distant whisper while warming the air with gentle heat, complemented by the room's neutral ivory ceilings and subtle bronze trims.","icon":"lightbulb"},{"title":"Biophilic Greenery Integration","description":"Lush potted ferns and trailing purple plants cascade vibrantly, their dewy leaves rustling softly in the breeze from an unseen vent and releasing a crisp, earthy freshness that purifies the air, blending emerald greens with the palette's sandy neutrals and soft terracottas.","icon":"leaf"},{"title":"Cozy Conversation Nook","description":"A low-slung white sofa, adorned with plush teal and crimson cushions, invites sinking into velvety softness with a faint linen whisper, surrounded by a marble-topped table that chills the hand against its veined coolness, all within a soothing blend of pearl whites, muted sages, and rosy accents.","icon":"couch"},{"title":"Artistic Decor Touches","description":"Sculptural wooden figures and abstract wall art add whimsical flair, their smooth curves begging a tactile trace while evoking a subtle woody tang, enhancing the sensory calm amid the design's refined palette of polished golds, matte charcoals, and warm ochres.","icon":"star"}]
JSON,
                'client_name' => NULL,
                'project_area' => 150.00,
                'start_date' => '2024-06-04',
                'completion_date' => '2024-06-07',
                'is_published' => 1,
                'is_featured' => 1,
            ],
            [
                'title' => 'Living and Open Kitchen',
                'slug' => 'living-and-open-kitchen',
                'description' => "This project showcases a sleek and sophisticated living room, blending modern aesthetics with functional design. The focal point is a wall-mounted television framed by a textured panel, complemented by integrated wooden shelves with accent lighting. The warm tones of wood and neutral walls create a cozy yet elegant ambiance, while carefully curated decor elements add personality and charm.\r\nThe open shelving unit combines style and utility, featuring minimalist decor and books for a contemporary touch. The inclusion of indoor greenery adds vibrancy, softening the room's modern lines and enhancing its inviting atmosphere. A plush sectional sofa and a minimalist glass coffee table complete the arrangement, ensuring both comfort and practicality.\r\nThis design reflects an attention to detail, merging luxury with everyday usability for a space that is both stunning and functional.and practicality.",
                'location' => 'United State of America',
                'year' => '2024',
                'type' => 'Minimalist Villa',
                'category' => 'residential',
                'main_image' => 'projects/Rm4UVLcramYw5QpRj2jP00MRkOPv7cGv9EsgWCOJ.png',
                'gallery_images' => json_encode(["projects/gallery/aSSuAxGtQT3E2vdkVuDTfkaaaC7fIi6qE3H9jqoC.png","projects/gallery/vzP6KaKH4h9PaW9d1Rd2EhXyOvDSdQ5eI9GyJN01.png","projects/gallery/nUnzDS4KXhumiI78wqcl770Igz9xrWG3mBdYP9ge.png","projects/gallery/4ysit99MZzFsNsWiuVbcX5mOLMI1c378O4LLNk82.png","projects/gallery/wDGEeiPme5FDTmK47S2bPKVzEsWDzoQ9rl5Wen5x.png"]),
                'video_url' => 'https://www.youtube.com/watch?v=wvVI5zkriuY&t=7s',
                'features' => <<<'JSON'
[{"title":"Open-Plan Layout","description":"A sweeping, airy expanse seamlessly merges the dining area, living space, and kitchen into a vibrant, social haven, where the faint clatter of dishes mingles with the soft hum of conversation, and the crisp scent of fresh herbs wafts through the air. The palette of soft beige walls, muted green cabinetry, and warm brown wooden tones creates a harmonious, earthy backdrop.","icon":"home"},{"title":"Wooden Accents","description":"Rich, warm wooden shelves, furniture, and flooring in deep chestnut and honey oak hues weave a natural, cozy tapestry, infusing the modern design with a rustic, golden glow that invites relaxation, their smooth texture cool to the touch and carrying a faint, earthy aroma.","icon":"hammer"},{"title":"Biophilic Elements","description":"Lush, verdant indoor plants with vibrant green leaves and delicate natural decor burst forth, transforming the space into a verdant oasis that purifies the air with every breath, the gentle rustle of leaves and the fresh, dewy scent enlivening the senses against a backdrop of soft ivory and sage accents.","icon":"tree"},{"title":"Modern Lighting","description":"Sleek, elegant pendant lights in sleek black frames cascade from above, casting a soft, golden glow that dances on the walls, while recessed ceiling lights hum faintly, creating an enchanting, welcoming ambiance that warms the skin, complemented by the neutral taupe ceiling.","icon":"lightbulb"},{"title":"Functional Storage","description":"Crystal-clear glass-fronted cabinets and open shelving in warm walnut tones brim with neatly arranged books, quirky decor, and kitchen treasures, the smooth glass cool under your fingers and the faint scent of aged paper adding a nostalgic touch, set against creamy off-white walls.","icon":"bolt"},{"title":"Comfortable Seating","description":"Plush, velvety upholstered chairs and a sprawling sectional sofa in soothing gray and beige upholstery, adorned with soft throws, cradle you in luxurious comfort for dining or lounging, the fabric yielding softly under your weight and exuding a subtle, clean linen scent.","icon":"couch"}]
JSON,
                'client_name' => NULL,
                'project_area' => 170.00,
                'start_date' => '2024-07-18',
                'completion_date' => '2024-07-25',
                'is_published' => 1,
                'is_featured' => 1,
            ],
            [
                'title' => 'Modern Bedroom Design',
                'slug' => 'modern-bedroom-design',
                'description' => "This contemporary bedroom design perfectly balances comfort and functionality, making it an ideal retreat for relaxation and productivity. The centerpiece of the room is a cozy bed framed by a wooden headboard with soft, neutral tones. A unique circular moon-inspired lighting fixture above the bed adds a calming ambiance, creating a serene environment.\r\nThe workspace is thoughtfully incorporated with a sleek desk and ergonomic chair, making it ideal for work or study. Adjacent shelving with integrated lighting and vibrant greenery enhances the room's warmth while maintaining a clean, organized look.\r\nThe use of natural wood finishes on the floors, doors, and furniture harmonizes with the soft lighting, giving the space an inviting and luxurious feel. Black accents in the chairs and pendant lights add a modern touch, tying together the room's aesthetic appeal.\r\nThis design showcases a seamless blend of style, functionality, and comfort, making it a standout addition to any portfolio.",
                'location' => 'Australia',
                'year' => '2024',
                'type' => 'Eco-Friendly Resort',
                'category' => 'residential',
                'main_image' => 'projects/7zzRH77Tr80WxsYLJQdEu6JnoVQ0uxVgQh62XRTC.png',
                'gallery_images' => json_encode(["projects/gallery/9wAj2luYIyznwaacstcZMuzDzYBv0sbdas2DHgmx.png","projects/gallery/NFCLIqhwimNSOAf61jIHLE9GkW4bq0VHjeVl6Jps.png","projects/gallery/MBcXEaugnmV3J7D10TRpWR37F17KdvI9cNIY4seI.png","projects/gallery/tsismqg9F1j5LQanBFUn9figYS4Z1VEPLVmdOJmy.png","projects/gallery/qXr0IZOnvcxPZdcPUumRLl36XWDEjuXC799KI54D.png"]),
                'video_url' => 'https://www.youtube.com/watch?v=Nsh40psYry8',
                'features' => <<<'JSON'
[{"title":"Wooden Accents","description":"A wooden headboard and flooring add warmth, complemented by a minimalist bed frame with neutral bedding.","icon":"home"},{"title":"Ambient Lighting","description":"Recessed ceiling lights and warm LED strips create a cozy atmosphere, enhanced by a striking moon-shaped wall light.","icon":"lightbulb"},{"title":"Biophilic Elements","description":"Hanging planters and potted plants bring greenery indoors, improving air quality and adding a natural touch.","icon":"leaf"},{"title":"Functional Furniture","description":"A stylish chair with a cushioned ottoman, a bedside table, and an integrated workspace with ergonomic seating offer versatility.","icon":"bed"},{"title":"Open Layout","description":"Large windows and an open-plan design with a workspace nook maximize natural light and space efficiency.","icon":"award"},{"title":"Modern Decor","description":"Shelving with books and decor items, along with a curved partition, adds sophistication and organization.","icon":"thumbs-up"}]
JSON,
                'client_name' => NULL,
                'project_area' => 180.00,
                'start_date' => '2024-01-04',
                'completion_date' => '2024-01-08',
                'is_published' => 1,
                'is_featured' => 1,
            ],
            [
                'title' => 'Vila No 07 in USA',
                'slug' => 'vila-no-07-in-usa',
                'description' => "This contemporary residence showcases a perfect balance of natural elements and modern architecture, creating a striking and sophisticated facade. The design integrates a mix of stone, wood, and metal textures, offering a visually dynamic and inviting exterior. The use of large glass panels enhances transparency and natural lighting, seamlessly blending indoor and outdoor spaces while maintaining privacy.\r\nLush greenery is thoughtfully incorporated into the architecture, with cascading plants adding a refreshing organic touch to the structured form. The landscaping complements the house’s aesthetic, featuring a combination of neatly arranged plants and natural stone pathways that enhance the connection to nature. The elevated entrance and sleek garage design contribute to the overall elegance and functionality of the space.\r\nThis design embodies modern luxury, combining sustainable materials with a timeless architectural approach. Every element, from the warm wooden paneling to the cool stone textures, has been carefully selected to create a home that is both stylish and harmonious with its surroundings. The result is a residence that exudes sophistication while maintaining a strong connection to nature.",
                'location' => 'United State of America',
                'year' => '2024',
                'type' => 'Eco-Friendly Resort',
                'category' => 'residential',
                'main_image' => 'projects/4vnzdExOL3Zxwsjb5o9Y3EUi1ew1wnEfjb5bSywn.png',
                'gallery_images' => json_encode(["projects/gallery/MoRhPX6WScACqxAgGitCKzFa84Z1SKyQgW9xTuZA.png","projects/gallery/GdWFgfwIL6FZ9pA1jbJMK936VEdkLntG1H8g0E1h.png","projects/gallery/ZILmneKkCY7wQu7IcQCaGFc7Tkk3dpfbK64VX7xP.png","projects/gallery/M0fJoFxukO6eF8szmCA25vk6l5vh7iAfLI3hJeHI.png","projects/gallery/NOVtgWVuvYuTZnrLXAsKaZCM7RuLOAYfkQU1F1Sd.png","projects/gallery/5LeOiXwoyhKLkLoKlGHOAAWphzUvas3u7Q8vAOtC.png"]),
                'video_url' => NULL,
                'features' => <<<'JSON'
[{"title":"Natural Integration","description":"Lush green vines hang from the carport and surround the entrance, blending seamlessly with the exterior, while a well-maintained garden and hedges enhance the natural aesthetic.","icon":"leaf"},{"title":"Modern Architecture","description":"The home features clean lines, a mix of stone and wooden cladding, and large windows, creating a contemporary look with a warm touch.","icon":"home"},{"title":"Functional Outdoor Space","description":"A spacious carport accommodates vehicles, with a smooth driveway adorned with fallen autumn leaves, adding seasonal charm.","icon":"recycle"},{"title":"Surrounding Environment","description":"The property is nestled among mature trees, providing a serene backdrop and natural privacy.","icon":"tree"},{"title":"Entrance Design","description":"A stone staircase leads to a wooden door, framed by greenery, offering an inviting and stylish entryway.","icon":"bolt"},{"title":"Sustainable Drainage","description":"The driveway and surrounding areas feature subtle drainage solutions, such as permeable paving, to manage rainwater effectively and support the natural landscape.","icon":"water"}]
JSON,
                'client_name' => NULL,
                'project_area' => 4200.00,
                'start_date' => '2024-05-13',
                'completion_date' => '2024-05-20',
                'is_published' => 1,
                'is_featured' => 1,
            ],
            [
                'title' => 'Walk-in Closet Design',
                'slug' => 'walk-in-closet-design',
                'description' => "This walk-in closet exemplifies luxury and organization, seamlessly blending functionality with aesthetic appeal. The space features a combination of open and enclosed storage solutions, highlighted by backlit wooden panels and glass-front wardrobes that exude sophistication. The warm tones of wood, combined with ambient lighting, create a cozy and inviting atmosphere.\r\nA central upholstered bench provides a comfortable space for dressing, while the angled ceiling and skylight enhance the room's openness, allowing natural light to highlight the intricate details. The herringbone wood ceiling adds texture and character, contributing to the refined yet modern design.\r\nThe inclusion of glass-topped display cases and open shelving ensures that accessories and clothing are both easily accessible and elegantly showcased. This design demonstrates meticulous attention to detail, making it a perfect retreat for style and functionality.",
                'location' => 'United Kindom',
                'year' => '2024',
                'type' => 'Eco-Friendly Resort',
                'category' => 'residential',
                'main_image' => 'projects/jHLVi4rKYVY5lIk0XEg8T1czjwvw1vzrszHPqPzx.png',
                'gallery_images' => json_encode(["projects/gallery/vGQmafnGtnM8R0g7Xky0kkoJhwOXbyV87WMfB9ov.png","projects/gallery/FunWmUpvV8B4PoPOHW0zPADzaeCzpr2mh82L77xk.png","projects/gallery/tbmJKqFl73hWlVhCltp3bhRyeqN781lR0jpfKdEI.png","projects/gallery/D4DNkkjyPh9SZBJWSSp3853KQLneNpulGA17slUp.png","projects/gallery/8x6M3xceeGvIIu7S43FJILQxGNhth4vG7EnYpSZB.png","projects/gallery/hVkNUTPIjeyZhGbKeydSH8vWPol5CNLJIXIhPJuk.png"]),
                'video_url' => 'https://www.youtube.com/watch?v=kTKcyIq7zDY',
                'features' => <<<'JSON'
[{"title":"Organized Wardrobe","description":"A spacious, well-lit wardrobe with glass doors, featuring neatly arranged clothes, shelves, and drawers for efficient storage.","icon":"cog"},{"title":"Warm Lighting","description":"Integrated LED lighting along shelves and ceilings creates a cozy and inviting ambiance throughout the space.","icon":"lightbulb"},{"title":"Biophilic Elements","description":"Indoor plants and natural decor, such as potted greenery and dried flowers, enhance air quality and add a touch of nature.","icon":"leaf"},{"title":"Elegant Vanity Area","description":"A stylish vanity with a round mirror, illuminated edges, and organized cosmetics, paired with a cushioned stool for a functional dressing space.","icon":"laptop"},{"title":"Wooden Accents","description":"Exposed wooden beams and flooring with a herringbone pattern add warmth and a modern rustic charm to the design.","icon":"hammer"},{"title":"Minimalist Furniture","description":"Sleek, low-profile furniture including a bench and glass-fronted cabinets, maintaining a clutter-free and contemporary aesthetic.","icon":"couch"}]
JSON,
                'client_name' => NULL,
                'project_area' => 120.00,
                'start_date' => NULL,
                'completion_date' => NULL,
                'is_published' => 1,
                'is_featured' => 1,
            ],
            [
                'title' => 'Open concept living and Dining',
                'slug' => 'open-concept-living-and-dining',
                'description' => "This project highlights a harmonious and stylish modern interior designed to suit contemporary residential living. The open-concept space seamlessly integrates the living, dining, and kitchen areas, creating an inviting and functional layout. A blend of natural wood textures, marble accents, and carefully curated décor elements reflects a sophisticated yet comfortable atmosphere. The floating TV console paired with warm lighting and a marble feature wall provides a striking focal point in the living area, balancing aesthetics and functionality. The dining area and kitchen boast a seamless connection, emphasizing practicality and elegance. The kitchen island, topped with marble, doubles as a breakfast bar and features statement pendant lighting that enhances its visual appeal. The dining table is strategically placed to encourage social gatherings, while the warm-toned wood flooring and sleek furniture enhance the modern ambiance. The open layout allows for natural light to flow freely, amplifying the space's brightness and creating a welcoming atmosphere. Adding the perfect finishing touches, the design incorporates lush greenery and soft furnishings to create a vibrant yet cozy environment. From the bold chandelier to the subtle wall-mounted shelves, every detail reflects a commitment to modern elegance and functionality. This interior design epitomizes the essence of contemporary residential living, merging practicality with timeless style.",
                'location' => 'Switzerland',
                'year' => '2024',
                'type' => 'Minimalist Villa',
                'category' => 'renovation',
                'main_image' => 'projects/L4fEwPBMDXR6BbvjpnedrphFZK6vbouUst9BXYNC.png',
                'gallery_images' => json_encode(["projects/gallery/RmqdhS1u0TwyvX54f9EVTVPr4xfHGDVma1HzdCur.png","projects/gallery/SQp3uP40SPU6qA418715i7cxZ8zmeMHzunJCvrz3.png","projects/gallery/6N3BpEDnG9DpmuoBonfySh4gmCqHmb9SWOqBo5uC.png","projects/gallery/ZTKQb8v7HMnUHAzLQP5pPFLO2izen45rdJqsKyDj.png"]),
                'video_url' => 'https://youtu.be/9CNXZxt6ANE?si=dWvOI1bCei62_JTy',
                'features' => <<<'JSON'
[{"title":"Biophilic Greenery","description":"Vibrant green plants, including lush monstera leaves, cascade throughout the space, their fresh, earthy scent filling the air and their soft rustle adding a natural rhythm, set against a soothing palette of creamy whites, rich greens, and warm wood tones.","icon":"leaf"},{"title":"Modern Lighting","description":"Recessed ceiling lights and elegant pendant fixtures cast a warm, golden glow that dances on the walls, their gentle hum and radiant heat creating an inviting ambiance, complemented by the room's neutral beige ceilings and subtle golden accents.","icon":"lightbulb"},{"title":"Open-Plan Kitchen and Dining","description":"A sleek, minimalist kitchen with white cabinetry and a marble-topped island flows into a dining area with wooden tables and cushioned chairs, the faint clatter of dishes and the crisp aroma of fresh fruit blending with the soft taupe and green hues.","icon":"home"},{"title":"Cozy Seating Area","description":"A plush, emerald-green sectional sofa with undulating curves invites sinking into velvety softness with a quiet whisper, surrounded by a glass coffee table that chills the hand, all harmonizing with the room's sandy neutrals and verdant accents.","icon":"couch"},{"title":"Warm Wooden Flooring","description":"Polished wooden floors in honey oak shades exude a smooth, cool texture underfoot with a subtle woody aroma, grounding the space in earthy warmth and tying together the palette of soft creams, muted greens, and golden highlights.","icon":"recycle"},{"title":"Stylish Decor Accents","description":"Artistic wall hangings, wooden bowls, and potted plants adorn the space, their tactile surfaces begging a gentle touch and releasing a faint, natural fragrance, enhancing the serene vibe amid a blend of ivory walls, rich browns, and vibrant green touches.","icon":"paint-brush"}]
JSON,
                'client_name' => NULL,
                'project_area' => 300.00,
                'start_date' => '2024-02-08',
                'completion_date' => '2024-02-13',
                'is_published' => 1,
                'is_featured' => 1,
            ],
            [
                'title' => 'Kitchen and Dinning',
                'slug' => 'kitchen-and-dinning',
                'description' => "This project features a sophisticated open-plan kitchen and dining area designed for both functionality and elegance. The kitchen boasts a modern black-and-gray color palette, enhanced with ambient lighting and sleek, matte finishes. The central island, equipped with bar seating, provides a perfect blend of practicality and social engagement, ideal for hosting and meal preparation. A striking wine display wall with integrated lighting adds a luxurious touch, while suspended glass racks above the island emphasize attention to detail. The wooden ceiling and flooring introduce warmth and texture, balancing the contemporary aesthetic with a cozy atmosphere. The adjoining dining area is anchored by a chic black dining table with high-back chairs, complemented by a centerpiece of candles and greenery for a refined yet welcoming vibe. Bold wall art adds a statement, harmonizing the modern design with artistic flair. This space is a perfect example of form meeting function in a luxurious residential setting.",
                'location' => 'United State of America',
                'year' => '2025',
                'type' => 'Green Hotel',
                'category' => 'residential',
                'main_image' => 'projects/ZmR0Va1Kt29WIa3VLR2rdvoSygrO3CJu8Dzu6xKN.png',
                'gallery_images' => json_encode(["projects/gallery/X0PiU8ovl0GgzNWpmC3uYN54yFzzTFHswcFUol9p.png","projects/gallery/IFiTSXvinDAiwDo2euaO7RvbDu9sgOKhnkzjMWWw.png","projects/gallery/yTNPl5ithCjN1lZwPKJIdVQNhEezq2tsKi1dNWpo.png","projects/gallery/43965uLsI0gfe92m98WXdexOzFMXbI55S3ItboET.png","projects/gallery/0aknDXjtCmfMbwLyKCinStXRvSfeTj4wUBjZIlRu.png","projects/gallery/SobfogC7uzPz0iAOpSMIngvBTR9yX6N2v4Xk73nq.png","projects/gallery/sfvWqedTeEZQ6pWIFYIELHbKeyNN1f6KalavJzvq.png","projects/gallery/UfOcFTfwmeqTAVcNjBsJca9DNA6ANXrTE1IUgJNw.png","projects/gallery/6PxzQIrj2LRpHcs77iElGAEE3Jr7CFQugw0Yar0f.png"]),
                'video_url' => 'https://youtu.be/BHcPggeqsZc?si=9QxSHq0oamfTErDC',
                'features' => <<<'JSON'
[{"title":null,"description":null,"icon":null},{"title":null,"description":null,"icon":null},{"title":null,"description":null,"icon":null},{"title":null,"description":null,"icon":null},{"title":null,"description":null,"icon":null},{"title":null,"description":null,"icon":null}]
JSON,
                'client_name' => NULL,
                'project_area' => 450.00,
                'start_date' => NULL,
                'completion_date' => NULL,
                'is_published' => 1,
                'is_featured' => 1,
            ]
        ];

        foreach ($projects as $project) {
            DB::table('projects')->updateOrInsert(
                ['slug' => $project['slug']],
                $project
            );
        }
    }
}
