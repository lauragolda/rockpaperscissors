<?php

class Element{
    private string $name;
    private Element $beats;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function getName(): string{
        return $this->name;
    }
    public function getBeats(): Element{
        return $this->beats;
    }
    public function setBeats(Element $element) : void{
        $this->beats = $element;
    }
}

class Game{
    private Element $player1;
    private Element $player2;

    public function __construct(Element $player1, Element $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }
    public function getWinner(): ?Element{
        if($this->player1->getName() === $this->player2->getName()){
            return null;
        }
        if($this->player1->getBeats()->getName() === $this->player2->getName()){
            return $this->player2;
        }
        return $this->player2;
    }
}

$player = "Player";
$computer = "Computer";

$rock = new Element("Rock");
$paper = new Element("Paper");
$scissors = new Element("Scissors");
$lizard = new Element("Lizard");
$spock = new Element("Spock");

$elements = [
    $rock,
    $paper,
    $scissors,
    $lizard,
    $spock,
];

$rock->setBeats($scissors);
$rock->setBeats($lizard);
$paper->setBeats($rock);
$paper->setBeats($spock);
$scissors->setBeats($paper);
$scissors->setBeats($lizard);
$lizard->setBeats($paper);
$lizard->setBeats($spock);
$spock->setBeats($scissors);
$spock->setBeats($rock);

foreach ($elements as $key => $element) {
    echo "[$key]{$element->getName()}" . PHP_EOL;
}

$selection = (int)readline("Enter your choice: ");

$selectedElement = $elements[$selection];
$opponentElement = $elements[array_rand($elements)];

$game = new Game($selectedElement, $opponentElement);
$winner = $game->getWinner();


echo $player.": ". $selectedElement->getName() . " VS " .$computer.": ". $opponentElement->getName() . PHP_EOL;
if ($winner === null) {
    echo "It's a tie". PHP_EOL;
    exit;
}

echo "Winner: {$winner->getName()}" . PHP_EOL;
