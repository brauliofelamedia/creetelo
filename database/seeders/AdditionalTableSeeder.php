<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdditionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('id',445)->with('additional')->first();
        $user->additional->how_vain = 'Ambicioso.';
        $user->additional->skills = 'Resolver problemas matemáticos complejos.';
        $user->additional->business_about = 'Estrategias de marketing y ventas.';
        $user->additional->corporate_job = 'Creo campañas publicitarias y analista datos de mercado.';
        $user->additional->mission = 'A lograr su estabilidad en sus proyectos y a mejorar sus alcances.';
        $user->additional->ideal_audience = 'Personas de edad intermedia 30 - 35 años.';
        $user->additional->dont_work_with = 'Sean conflictivas y se enfoquen más en los problemas que en resolverlos.';
        $user->additional->values = 'Honesto, responsable y comprometido.';
        $user->additional->tone = 'Profesional.';
        $user->additional->looking_for_in_creelo = 'Un medio para desarrollarme y lograr ayudar a los demas.';
        $user->additional->birthplace = 'Nací en Tepic Nayarit.';
        $user->additional->sign = 'Escorpión.';
        $user->additional->hobbies = 'Aprender idiomas.';
        $user->additional->favorite_drink = 'Cerveza y tequila.';
        $user->additional->has_children = 'Si, 2 hijos.';
        $user->additional->is_married = 'Si';
        $user->additional->favorite_trip = 'Me gusta mucho ir a la playa.';
        $user->additional->next_trip = 'Me gustaría ir a Cancún.';
        $user->additional->favorite_dessert = 'Pastel de tres leches.';
        $user->additional->favorite_food = 'Costillas en salsa verde.';
        $user->additional->movie_recommendation = 'Serie "Breaking bad" y película "Rescatando al soldado Ryan".';
        $user->additional->book_recommendation = 'El principito y los 4 acuerdos.';
        $user->additional->podcast_recommendation = 'No escucho PODCAST.';
        $user->additional->irreplaceable = 'Mis valores, congruencia en lo que hago y lo que digo.';
        $user->additional->achievement = 'Logré tener una familia, y los hijos que tanto soñé.';
        $user->additional->biggest_dream = 'Mi sueño más grande es obtener una estabilidad monetaria y mental para poder ayudar a más personas.';
        $user->additional->gift = 'Un producto que te ayudara a tener más energía y te ayudara a estar más centrado en tus actividades.';
        $user->additional->gift_link = 'https://www.amazon.com.mx/Citrato-Magnesio-C%C3%A1psulas-Life-Magnesium/dp/B09BDFV9JF';
        $user->additional->like_to_receive = 'Me gustaría recibir conocimientos sobre como sentirme mejor, disfrutar de la vida, sonreír más.';
        $user->additional->brings_you_happiness = 'Me gusta disfrutar de mi familia.';
        $user->additional->save();

        $user = User::where('id',447)->with('additional')->first();
        $user->additional->how_vain = 'Ambicioso.';
        $user->additional->skills = 'Resolver problemas matemáticos complejos.';
        $user->additional->business_about = 'Estrategias de marketing y ventas.';
        $user->additional->corporate_job = 'Creo campañas publicitarias y analista datos de mercado.';
        $user->additional->mission = 'A lograr su estabilidad en sus proyectos y a mejorar sus alcances.';
        $user->additional->ideal_audience = 'Personas de edad intermedia 30 - 35 años.';
        $user->additional->dont_work_with = 'Sean conflictivas y se enfoquen más en los problemas que en resolverlos.';
        $user->additional->values = 'Honesto, responsable y comprometido.';
        $user->additional->tone = 'Profesional.';
        $user->additional->looking_for_in_creelo = 'Un medio para desarrollarme y lograr ayudar a los demas.';
        $user->additional->birthplace = 'Nací en Tepic Nayarit.';
        $user->additional->sign = 'Escorpión.';
        $user->additional->hobbies = 'Aprender idiomas.';
        $user->additional->favorite_drink = 'Cerveza y tequila.';
        $user->additional->has_children = 'Si, 2 hijos.';
        $user->additional->is_married = 'Si';
        $user->additional->favorite_trip = 'Me gusta mucho ir a la playa.';
        $user->additional->next_trip = 'Me gustaría ir a Cancún.';
        $user->additional->favorite_dessert = 'Pastel de tres leches.';
        $user->additional->favorite_food = 'Costillas en salsa verde.';
        $user->additional->movie_recommendation = 'Serie "Breaking bad" y película "Rescatando al soldado Ryan".';
        $user->additional->book_recommendation = 'El principito y los 4 acuerdos.';
        $user->additional->podcast_recommendation = 'No escucho PODCAST.';
        $user->additional->irreplaceable = 'Mis valores, congruencia en lo que hago y lo que digo.';
        $user->additional->achievement = 'Logré tener una familia, y los hijos que tanto soñé.';
        $user->additional->biggest_dream = 'Mi sueño más grande es obtener una estabilidad monetaria y mental para poder ayudar a más personas.';
        $user->additional->gift = 'Un producto que te ayudara a tener más energía y te ayudara a estar más centrado en tus actividades.';
        $user->additional->gift_link = 'https://www.amazon.com.mx/Citrato-Magnesio-C%C3%A1psulas-Life-Magnesium/dp/B09BDFV9JF';
        $user->additional->like_to_receive = 'Me gustaría recibir conocimientos sobre como sentirme mejor, disfrutar de la vida, sonreír más.';
        $user->additional->brings_you_happiness = 'Me gusta disfrutar de mi familia.';
        $user->additional->save();
    }
}
