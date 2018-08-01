<?php
/**
 * Created by PhpStorm.
 * User: Pichau
 * Date: 31/07/2018
 * Time: 22:24
 */

    require_once 'DBConnection.php';
    require_once 'Reserva.php';

class ReservaCrud
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }

    public function getReserva($id)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = 'select * from reservas where id='.$id;
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $reserva = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoReserva = new Reserva(
            $reserva['nome'],
            $reserva['cor'],
            $reserva['entrada'],
            $reserva['saida'],
            $reserva['id_local'],
            $reserva['id_user'],
            $reserva['id']);

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoReserva;

    }


    public function getReservas()
    {
        $sql = "SELECT * FROM reservas";

        $resultado = $this->conexao->query($sql);

        $reservas = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($reservas as $reserva) {
            $nome = $reserva['nome'];
            $cor = $reserva['cor'];
            $entrada = $reserva['entrada'];
            $saida = $reserva['saida'];
            $idlocal = $reserva['id_local'];
            $iduser = $reserva['id_user'];
            $id = $reserva['id'];

            $obj = new Reserva($nome, $cor, $entrada, $saida, $idlocal,$iduser, $id);
            $ListaReserva[] = $obj;
        }
        return $ListaReserva;
    }

    public function getReservasLocal($idlocal)
    {
        $sql = 'SELECT * FROM reservas WHERE id_local = '.$idlocal;

        $resultado = $this->conexao->query($sql);

        $reservas = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($reservas as $reserva) {
            $nome = $reserva['nome'];
            $cor = $reserva['cor'];
            $entrada = $reserva['entrada'];
            $saida = $reserva['saida'];
            $idlocal = $reserva['id_local'];
            $iduser = $reserva['id_usuario'];
            $id = $reserva['id'];

            $obj = new Reserva($nome, $cor, $entrada, $saida, $idlocal,$iduser, $id);
            $ListaReserva[] = $obj;
        }
        return $ListaReserva;
    }
    public function getReservasLocalArray($idlocal)
    {
        $sql = 'SELECT * FROM reservas WHERE id_local = '.$idlocal;

        $resultado = $this->conexao->exec($sql);

        return $resultado;
    }
    public function insereReserva(Reserva $reserva){
        $sql = "INSERT INTO reservas (nome, cor, entrada, saida, id_local, id_usuario) 
                values ('{$reserva->getNome()}','{$reserva->getCor()}','{$reserva->getEntrada()}','{$reserva->getSaida()}', '{$reserva->getIdLocal()}','{$reserva->getIdUser()}')";

        try {//TENTA EXECUTAR A INSTRUCAO

            echo $sql;
            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }
}