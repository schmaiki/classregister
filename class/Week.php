<?php


class Week
{
    // PK
    private int $id;
    // Woche
    private int $weekNo;
    // Thema
    private $modul;
    // Dozent
    private string $doz;
    // Bemerkung
    private string $notice;
    // 10 string Einträge
    private $entrys = [];

    /**
     * week constructor.
     * @param int $id
     * @param int $weekNo
     * @param $modul
     * @param string $doz
     * @param string $notice
     * @param array $entrys
     */
    public function __construct(int $id, int $weekNo, $modul, string $doz, string $notice, array $entrys)
    {
        $this->id = $id;
        $this->week = $weekNo;
        $this->modul = $modul;
        $this->doz = $doz;
        $this->notice = $notice;
        $this->entrys = $entrys;
    }

    /**
     * week creater
     * @param int $weekNo
     * @param $modul
     * @param string $doz
     * @param string $notice
     * @param array $entrys
     */
    public function create(int $weekNo, $modul, string $doz, string $notice, array $entrys)
    {
        //$this->id = $id;
        $this->weekNo = $weekNo;
        $this->modul = $modul;
        $this->doz = $doz;
        $this->notice = $notice;
        $this->entrys = $entrys;

        // Insert into db
        // insert_id auslesen
        // und diesem Objekt zuweisen
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public static function getByWeekNo(int $weekNo) : Week
    {
        try {
            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'SELECT * FROM calweek WHERE weekNo = :weekNo';
            $sth = $dbh->prepare($sql); // $sth für PDOStatement (prepared Statement)
            $sth->bindParam('weekNo',$weekNo,PDO::PARAM_INT);
            $sth->execute();
            $calWeeks = $sth->fetchAll(PDO::FETCH_FUNC, 'week::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $calWeeks[0];
    }
    public static function buildFromPDO(int $id, int $weekNo, string $modul, string $doz, string $notice,
                                        string $entry0, string $entry1, string $entry2, string $entry3,
                                        string $entry4, string $entry5, string $entry6, string $entry7,
                                        string $entry8, string $entry9)
    {
        $entrys = [$entry0, $entry1, $entry2, $entry3, $entry4, $entry5, $entry6, $entry7, $entry8, $entry9];
        $w = new Week($id, $weekNo, $modul, $doz, $notice,  $entrys);
        return $w;
    }
    /**
     * @return int
     */
    public function getWeek(): int
    {
        return $this->week;
    }

    /**
     * @return mixed
     */
    public function getModul()
    {
        return $this->modul;
    }

    /**
     * @return string
     */
    public function getDoz(): string
    {
        return $this->doz;
    }

    /**
     * @return string
     */
    public function getNotice(): string
    {
        return $this->notice;
    }

    /**
     * @return array
     */
    public function getEntrys(): array
    {
        return $this->entrys;
    }



}