<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;

class CardController extends Controller
{
	// define a value for each card in the deck - doesnt matter which suite
	private $suits			= array('hearts', 'diamonds', 'clubs', 'spades');
	private $deck_values	= array('1' => 'A', '2' , '3', '4', '5', '6', '7', '8', '9', '10', '11' => 'J', '12' => 'Q', '13' => 'K');
	private $new_card;
	private $cards_left;

	public function __construct()
	{
		// check to see if a deck exists
		if (!Session::get('deck'))
		{
			// reset high score
			Session::put('high_score',	0);

			// save
			Session::save();

			// shuffle deck
			$this->shuffleDeck();
		}
	}

    // initial view
	public function index()
	{
		// get card
		$this->getCard();

		// view
		return view('game', ['card'			=> $this->new_card['face'],
							 'card_suit'	=> $this->new_card['suit'],
							 'cards_left'	=> $this->cards_left,
							 'deck'			=> print_r(Session::get('deck'), true),
							 'score'		=> Session::get('score'),
							 'lives'		=> Session::get('lives'),
							 'high_score'	=> Session::get('high_score'),
							 'debug'		=> 'new game']);
	}

	// shuffle deck
	public function shuffleDeck()
	{
		// iterate over the four suits
		foreach ($this->suits as $suit) {

			// produce 13 cards for each suit
			foreach($this->deck_values AS $key => $value) {

				// produce the 13 cards
				$deck[] = array('suit' => $suit, 'value' => $key, 'face' => $value);
			}
		}

		// shuffle them
		shuffle($deck);

		// define session
		Session::put('deck',		$deck);
		Session::put('card',		'');
		Session::put('card_value',	'');
		Session::put('card_suit',	'');
		Session::put('cards_left',	52);
		Session::put('score',		0);
		Session::put('lives',		3);

		// save
		Session::save();

		// redirect - new game
		return redirect('higherlower');
	}

	// new card is higher than the existing card
	public function higher()
	{

		// retrieve current card
		$current_card = Session::get('card_value');

		// get new card
		$this->getCard();

		// check for success
		if ($this->new_card['value'] > $current_card)
		{
			// add a point to score
			$this->addScore();

		} else {

			// remove a life
			$this->useLife();
		}

		// view
		return view('game', ['card'			=> $this->new_card['face'],
							 'card_suit'	=> $this->new_card['suit'],
							 'cards_left'	=> $this->cards_left,
							 'deck'			=> print_r(Session::get('deck'), true),
							 'score'		=> Session::get('score'),
							 'lives'		=> Session::get('lives'),
							 'high_score'	=> Session::get('high_score'),
							 'debug'		=> $this->new_card['face'] . ' > ' . $current_card]);
	}
	
	// new card is lower than the existing card
	public function lower()
	{

		// retrieve current card
		$current_card = Session::get('card_value');

		// get new card
		$this->getCard();

		// check for success
		if ($this->new_card['value'] < $current_card)
		{
			// add a point to score
			$this->addScore();

		} else {

			// remove a life
			$this->useLife();
		}

		// view
		return view('game', ['card'			=> $this->new_card['face'],
							 'card_suit'	=> $this->new_card['suit'],
							 'cards_left'	=> $this->cards_left,
							 'deck'			=> print_r(Session::get('deck'), true),
							 'score'		=> Session::get('score'),
							 'lives'		=> Session::get('lives'),
							 'high_score'	=> Session::get('high_score'),
							 'debug'		=> $this->new_card['face'] . ' > ' . $current_card]);
	}

	// get next card
	private function getCard()
	{
		// retrieve session
		$deck				= Session::get('deck');
		$this->cards_left	= Session::get('cards_left');

		// pick next card
		$this->new_card			= array_pop($deck);
		$this->cards_left--;

		// update session
		Session::put('card',		$this->new_card['face']);
		Session::put('card_value',	$this->new_card['value']);
		Session::put('card_suit',	$this->new_card['suit']);
		Session::put('cards_left',	$this->cards_left);
		Session::put('deck',		$deck);

		// save session
		Session::save();
	}

	private function addScore()
	{

		// retrieve current score
		$score = (int) Session::get('score');

		// add point
		$score++;

		// check for no cards left
		if (count(Session::get('deck')) == 0) {

			// update high score
			Session::put('high_score', Session::get('score'));
		}

		// update session
		Session::put('score', $score);

		// save session
		Session::save();
	}

	private function useLife()
	{

		// retrieve current lives
		$lives = (int) Session::get('lives');

		// remove life
		$lives--;

		// check for no lives left
		if ($lives == 0) {

			// check for current score beats the high score
			if (Session::get('score') > Session::get('high_score')) {

				// update high score
				Session::put('high_score', Session::get('score'));
			}
		}

		// update session
		Session::put('lives', $lives);

		// save session
		Session::save();
	}
}
