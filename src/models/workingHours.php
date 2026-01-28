<?php

class workingHours extends Model{
    protected static $tableName = 'working_hours';
    protected static $columns = [
        //'id',
        'user_id', 
        'work_date', 
        'time1',  
        'time2',  
        'time3',
        'time4',
        'worked_time'
    ];


    public static function loadFromUserDate($userId, $workDate){
        //search only registry from dataBase
        $registry = self::getResultFromDataBaseOnly([
            'user_id' => $userId, 
            'work_date' => $workDate
        ]);


        //registry == null
        if (!$registry){
            $registry = new workingHours([
                'user_id' => $userId,
                'work_date' => $workDate,
                'time1' => null,
                'time2' => null,
                'time3' => null,
                'time4' => null,
                'worked_time' => 0
            ]);
        }

        return $registry;
    }   
    
    
    /*
        getNextTime()
        description: obter o proximo time para o batimento de ponto.
        obs: pertecente a instancia, nao estatico
        assunto: verificar qual batimento precisar ser atribuido no momento em que for chamado!
        retorna a string da coluna que deve ser atribuida um time, se todas tiverem ja preenchidas
        retorna null
    */ 
    public function getNextTime(){
        if (!$this->time1) return 'time1';
        if (!$this->time2) return 'time2';
        if (!$this->time3) return 'time3';
        if (!$this->time4) return 'time4';
        return null;
    }

    /*
        innout($time)  
        description: atribuir um time na banco de dados, tabela workingHours
        assunto: recebe um time ou nao, se nao, retornar uma execption ao sistema, informando 
        o usuario que todos o batimento ja foram feitos, se sim, atribui na tabela workingHours o novo 
        batimento.
        tecnico: Recebe um parametro string time -> "08:00:00" ou seja, um valor em hora no formato \
        de string. E feito
    */ 
    public function innout($time){
        $timeColumn = $this->getNextTime();
    
        //attention
        if (!$timeColumn){
            throw new AppException("you've alredy done all four clock in for the day!");
        }

        /*
        Quando chamarmos uns dos metodos "insertFrom.. ou updateFrom.." que precisar ser setado no 
        atributo time1, time2... vai esta "atualizado" para uso!!!
        */
        $this->$timeColumn = $time;
 
        //if seted, update, if not, insert
        //aqui utilizando
        //"$this->id" chave retornando do banco
        if (!$this->id){
            $this->insertFromDataGenerator();
        } else {
            $this->updateFromDataGenerator();
        }
    }

    //calculo de intervalo de horas trabalhadas
    function getWorkedInterval() {
        //pegando valores de time
        [$t1, $t2, $t3, $t4]  = $this->getTime();

        //organizando manha e tarde, zerando ambos
        //obs: Os parametros de dateInterval sao da documentação
        $morning = new DateInterval('PT0S');
        $afternoo = new DateInterval('PT0S');

        //calcs
        /*
        Description: o objetivo e calcular as diferenças dos batimentos
        usando a estrategia de "manha e tarde", no primeiro batimento da manhã é zerado, 
        feita a diferança no segundo batimento, pela tarde mesmo principio, o batimento da tarde 
        e "zerado", feita a diferença no ultimo batimento, que seria o quarto batimento.
        */

        if ($t1) $morning = $t1->diff(new DateTime());
        if ($t2) $morning = $t1->diff($t2);
        if ($t3) $afternoo = $t3->diff(new DateTime());
        if ($t4) $afternoo = $t3->diff($t4);

        return sumIntervals($morning, $afternoo);
    }

    //lunch interval calc
    function getLunchInterval() {
        [, $t2, $t3,] = $this->getTime();

        //valor zerado
        $breakValueTotal = new DateInterval('PT0S');

        if ($t2) $breakValueTotal = $t2->diff(new DateTime());
        if ($t3) $breakValueTotal = $t2->diff($t3);

        return $breakValueTotal;

    }

    //exit calc
    /*
        calculo do dia inteiro trabalhado mais a hora de almoço, deve totalizar 8h.
        8h horas pós e necessário para o calculo está certo, e somada a hora de entrada +
        a hora do almoço para dar uma "estimativa" do horário da saída, se caso, o batimento 
        da saido ainda não estive efetuado, o sistema deve mostrar a estimativa da saida.

        detalhes: horário de entrada + 8h padrão + hora do almoço = estimativa da saida'
    */
    function getExitTime() {
        [$t1, , , $t4] = $this->getTime();

        //criando um date interval apartir de um metodo estatico
        $workday = DateInterval::createFromDateString('8 hours');


        //testar---- urgente 
        if (!$t1) {
            return (new DateTimeImmutable())->add($workday);
        } elseif ($t4) {
            return $t4;
        } else {
            $totalWorkDay = sumIntervals($workday, $this->getLunchInterval());

            return $t1->add($totalWorkDay);
        }
    }

    //converter timestamp para cada time
    private function getTime() {
        $time = [];

        //addionando nos times1 no array $time()
        $this->time1 ? array_push($time, getDateFromString($this->time1)) : array_push($time, null);
        $this->time2 ? array_push($time, getDateFromString($this->time2)) : array_push($time, null);
        $this->time3 ? array_push($time, getDateFromString($this->time3)) : array_push($time, null);
        $this->time4 ? array_push($time, getDateFromString($this->time4)) : array_push($time, null);

        return $time;
    }
}