<?php

namespace App\Controller;

use Exception;

use App\Dice\Dice;
use App\Dice\DiceGraphic;
use App\Dice\DiceHand;
use App\Dice\DiceGameTask;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiceGameController extends AbstractController
{
    /**
     * Display the homepage of the Pig game.
     */
    #[Route("/game/pig", name: "pig_start")]
    public function home(): Response
    {
        return $this->render('pig/home.html.twig');
    }
    /**
     * Test rolling a single dice.
     */
    #[Route("/game/pig/test/roll", name: "test_roll_dice")]
    public function testRollDice(): Response
    {
        $die = new Dice();

        $data = [
            "dice" => $die->roll(),
            "diceString" => $die->getAsString(),
        ];
        return $this->render('pig/test/roll.html.twig', $data);
    }
/**
 * Test rolling multiple dices.
 * @param int $num The number of dices to roll.
 * @throws Exception If the number of dices is greater than 99.
 */
    #[Route("/game/pig/test/roll/{num<\d+>}", name: "test_roll_num_dices")]
    public function testRollDices(int $num): Response
    {
        if ($num > 99) {
            throw new Exception("Can not roll more than 99 dices!");
        }
        $diceRoll = [];
        for ($i = 1; $i <= $num; $i++) {
            $die = new DiceGraphic();
            $die->roll();
            $diceRoll[] = $die->getAsString();
        }
        $data = [
            "num_dices" => count($diceRoll),
            "diceRoll" => $diceRoll,
        ];
        return $this->render('pig/test/roll_many.html.twig', $data);
    }
/**
 * Test rolling a dice hand.
 * @param int $num The number of dices in the hand.
 * @param DiceGameTask $diceGameTask
 */
    #[Route("/game/pig/test/dicehand/{num<\d+>}", name: "test_dicehand")]
    public function testDiceHand(int $num, DiceGameTask $diceGameTask): Response
    {
        $data = $diceGameTask->rollDiceHand($num);
        return $this->render('pig/test/dicehand.html.twig', $data);
    }
    /**
     * Initialize the Pig game (GET).
     *
     */
    #[Route("/game/pig/init", name: "pig_init_get", methods: ['GET'])]
    public function init(): Response
    {
        return $this->render('pig/init.html.twig');
    }
    /**
     * Initialize the Pig game (POST).
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    #[Route("/game/pig/init", name: "pig_init_post", methods: ['POST'])]
    public function initCallback(
        Request $request,
        SessionInterface $session
    ): Response {
        $numDice = $request->request->get('num_dices');
        $hand = new DiceHand();
        for ($i = 1; $i <= $numDice; $i++) {
            $hand->add(new DiceGraphic());
        }
        $hand->roll();
        $session->set("pig_dicehand", $hand);
        $session->set("pig_dices", $numDice);
        $session->set("pig_round", 0);
        $session->set("pig_total", 0);
        return $this->redirectToRoute('pig_play');
    }
    /**
     * Play the Pig game (GET).
     * @param SessionInterface $session
     * @return Response
     */
    #[Route("/game/pig/play", name: "pig_play", methods: ['GET'])]
    public function play(
        SessionInterface $session
    ): Response {
        $dicehand = $session->get("pig_dicehand");
        $data = [
            "pigDices" => $session->get("pig_dices"),
            "pigRound" => $session->get("pig_round"),
            "pigTotal" => $session->get("pig_total"),
            "diceValues" => $dicehand->getString()
        ];
        return $this->render('pig/play.html.twig', $data);
    }
    /**
     * Roll the dice in the Pig game (POST).
     * @param SessionInterface $session
     * @param DiceGameTask $diceGameTask
     * @return Response
     */
    #[Route("/game/pig/roll", name: "pig_roll", methods: ['POST'])]
    public function roll(
        SessionInterface $session,
        DiceGameTask $diceGameTask
    ): Response {
        $diceGameTask->rollAndUpdateRound($session);
        return $this->redirectToRoute('pig_play');
    }
/**
 * Save the current round total in the Pig game (POST).
 * @param SessionInterface $session
 * @return Response
 */
    #[Route("/game/pig/save", name: "pig_save", methods: ['POST'])]
    public function save(
        SessionInterface $session
    ): Response {
        $roundTotal = $session->get("pig_round");
        $gameTotal = $session->get("pig_total");
        $session->set("pig_round", 0);
        $session->set("pig_total", $roundTotal + $gameTotal);
        $this->addFlash(
            'notice',
            'Your round was saved to the total!'
        );
        return $this->redirectToRoute('pig_play');
    }
}
