<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('frontend.index');
    }

    public function experiences(){
        return view('frontend.experiences');
    }

    public function research(){
        return view('frontend.research');
    }

    public function blog(){
        $posts = DB::connection('mysql2')->select("SELECT kab_posts.ID,kab_posts.post_date,kab_posts.post_title,kab_posts.post_name, mp.meta_value, kab_posts.post_content,
                       (select wpp.guid from kab_posts wpp
                                            where wpp.post_type='attachment' and wpp.ID = mp.meta_value) as guid,
                    kab_terms.name,kab_terms.slug
                from kab_posts
                         join kab_postmeta mp on kab_posts.ID = mp.post_id
                         join kab_term_relationships on kab_posts.ID = kab_term_relationships.object_id
                         join kab_terms on kab_term_relationships.term_taxonomy_id = kab_terms.term_id
                         join kab_term_taxonomy on kab_term_relationships.term_taxonomy_id = kab_term_taxonomy.term_taxonomy_id
                WHERE kab_posts.post_status = 'publish' and kab_posts.post_type='post' and mp.meta_key='_thumbnail_id' and slug = 'xenerit'
                ORDER BY kab_posts.ID desc");
        return view ('frontend.blog', compact('posts'));
    }

    public function blogView($post){
        $post = collect(DB::connection('mysql2')->select("SELECT kab_posts.ID,kab_posts.post_date,kab_posts.post_title,kab_posts.post_name, mp.meta_value, kab_posts.post_content,
                       (select wpp.guid from kab_posts wpp
                                            where wpp.post_type='attachment' and wpp.ID = mp.meta_value) as guid,
                    kab_terms.name,kab_terms.slug
                from kab_posts
                         join kab_postmeta mp on kab_posts.ID = mp.post_id
                         join kab_term_relationships on kab_posts.ID = kab_term_relationships.object_id
                         join kab_terms on kab_term_relationships.term_taxonomy_id = kab_terms.term_id
                         join kab_term_taxonomy on kab_term_relationships.term_taxonomy_id = kab_term_taxonomy.term_taxonomy_id
                WHERE kab_posts.post_status = 'publish' and kab_posts.post_type='post' and mp.meta_key='_thumbnail_id' and slug = 'xenerit' and kab_posts.post_name = '$post'
                ORDER BY kab_posts.ID desc"))->first();
        return view ('frontend.blogView', compact('post'));
    }
}
