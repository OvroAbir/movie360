<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;



class MovieTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function testGoToMoviePage()
    {
        $this->assertTrue(true);

        $this->visit('/movies')
        	->click('The Shawshank Redemption')
        	->seePageIs('/movies/1');
        	
        $this->visit('/movies')
        	->click('Harry Potter and the Sorcerers Stone')
        	->seePageIs('/movies/2');
        	
        $this->visit('/movies')
        	->click('The Dark Knight')
        	->seePageIs('/movies/3');
        	
        $this->visit('/movies')
        	->click('Inception')
        	->seePageIs('/movies/4');
        	
        $this->visit('/movies')
        	->click('Daruchini Dip')
        	->seePageIs('/movies/5');
        	
        $this->visit('/movies')
        	->click('The Dark Knight Rises')
        	->seePageIs('/movies/6');
        	
        $this->visit('/movies')
        	->click('Batman Begins')
        	->seePageIs('/movies/7');
        	
        $this->visit('/movies')
        	->click('Harry Potter and the Goblet of Fire')
        	->seePageIs('/movies/8');
        	
        $this->visit('/movies')
        	->click('Harry Potter and the Prisoner of Azkaban')
        	->seePageIs('/movies/9');
        	
        $this->visit('/movies')
        	->click('Edge of Tomorrow')
        	->seePageIs('/movies/10');
        	
        $this->visit('/movies')
        	->click('Mission: Impossible - Rogue Nation')
        	->seePageIs('/movies/11');
    }

    public function testMoviePage()
    {
    	$this->assertTrue(true);

    	$this->visit('/movies/1')
    		->see('The Shawshank Redemption')
    		->see('142 min');

    	$this->visit('/movies/2')
    		->see('Harry Potter and the Sorcerers Stone')
    		->see('152 min');
    		
    	$this->visit('/movies/3')
    		->see('The Dark Knight')
    		->see('152 min');
    		
    	$this->visit('/movies/4')
    		->see('Inception')
    		->see('148 min');
    		
    	$this->visit('/movies/5')
    		->see('Daruchini Dip')
    		->see('161 min');
    		
    	$this->visit('/movies/6')
    		->see('The Dark Knight Rises')
    		->see('164 min');
    		
    	$this->visit('/movies/7')
    		->see('Batman Begins')
    		->see('140 min');
    		
    	$this->visit('/movies/8')
    		->see('Harry Potter and the Goblet of Fire')
    		->see('157 min');
    		
    	$this->visit('/movies/9')
    		->see('Harry Potter and the Prisoner of Azkaban')
    		->see('142 min');
    		
    	$this->visit('/movies/10')
    		->see('Edge of Tomorrow')
    		->see('113 min');
    		
    	$this->visit('/movies/11')
    		->see('Mission: Impossible - Rogue Nation')
    		->see('131 min');
    		
    }

    // public function testSearch()
    // {
    // 	$this->assertTrue(true);

    // 	$this->visit('/searchpage')
    // 		->type('harry', 'movieName')
    // 		->type('mike', 'directorName')
    // 		->type('warner', 'productionHouse')
    // 		->type('rad', 'actorName')
    // 		->press('Search')
    // 		//->see('Harry Potter and the Goblet of Fire')
    // 		//->see('Harry Potter and the Prisoner of Azkaban');
    // 		->seePageIs('/searchMovie');
    // }

    public function testDatabase()
    {
        $this->assertTrue(true);

        $this->seeInDatabase('users', ['email'=>'joy@gmail.com']);

        $user = factory(App\User::class)->create();
    }

}
