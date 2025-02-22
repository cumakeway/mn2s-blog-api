<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Services\Hash;

class GetBlogPostsFromWordPress extends Command
{
    private $client ;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-blog-posts-from-wordpress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command retrieves blog posts from the Wordpress REST API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{
            $this->client = new Client();
            $response = $this->client->request('GET', ENV('WORDPRESS_ROOT_URL')."/wp-json/wp/v2/posts", [
                'headers' => [],
            ]); 
            $blog_posts = json_decode($response->getBody()); 

            if(!empty($blog_posts)){
                $counter = 0;
                foreach($blog_posts as $blog_post)
                {
                    $hash = Hash::factory()->sha1($blog_post->title->rendered);
                    $savedBlogPost = Post::where('hash', $hash)->first();
                    if ($savedBlogPost) {
                        continue;
                    }

                    $post = new Post();
                    $post->title = $blog_post->title->rendered;
                    $post->slug = $blog_post->slug;
                    $post->excerpt = $blog_post->excerpt->rendered;
                    $post->content = $blog_post->content->rendered;
                    $post->hash = $hash; 
                    $post->date_posted = $blog_post->date;
                    $post->save();
                    $counter++;
                }
                $this->message("Successfully saved $counter blog posts");
            } else{
                $this->message('Blog posts are empty!');
            }
        } catch(ClientException $exception){
            $this->message("An error occurred because: ".$exception
            ->getResponse()->getBody()->getContents());
        }  
    }

    private function message($message): void
    {
        echo "{$message}\n";
    }
}