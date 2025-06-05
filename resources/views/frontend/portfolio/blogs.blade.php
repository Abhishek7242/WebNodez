    <section class="all-blogs">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Latest Articles</span>
                <h2 class="section-title">Explore Our Blogs</h2>
                <p class="section-description">Discover insights, tutorials, and industry trends from our expert team</p>
            </div>

       
            <div class="flex flex-wrap justify-center gap-10">
                @foreach ($blogs->take(4) as $blog)
                <x-blog-card 
                    :image="$blog->featured_image" 
                    :category="$blog->category" 
                    :title="$blog->title" 
                    :excerpt="Str::limit(strip_tags($blog->content), 150)" 
                    :date="$blog->created_at->format('F d, Y')" 
                    :link="'/blog/' . $blog->slug" 
                />
            @endforeach
            
            </div>

            <div class="load-more-container">
                <a href="/blogs" class="load-more-btn">
                    <span>Read More  <span class="arrow">▶</span></span>
                  
                </a>
            </div>
        </div>
    </section>