<?php

namespace System\Databases\Objects\Unused;

use System\Databases\BaseObject;

/**
 * @method static Game[] getAll()
 * @method static Game getById($id)
 */
class Game extends BaseObject
{

    protected static string $table = 'games';
    protected static array $joinForeignKeys = [
        'developer_id' => [
            'table' => 'developers',
            'object' => 'System\Databases\Objects\Unused\Developer'
        ]
    ];

    public ?int $id = null;
    public ?int $developer_id = null;
    public string $name = '';
    public string $description = '';
    public float $rating = 0;
    public int $year = 0;
    public string $image = '';
    private array $genreIds = [];


    /**
     * @return bool
     */
    public function saveGenres(): bool
    {
        try {
            $this->db->beginTransaction();

            //Delete all current references
            $statement = $this->db->prepare('DELETE FROM game_genre WHERE game_id = :game_id');
            $statement->execute([':game_id' => $this->id]);

            //Add the current references
            foreach ($this->genreIds as $genreId) {
                $statement = $this->db->prepare('INSERT INTO game_genre (genre_id, game_id) VALUES (:genre_id, :game_id)');
                $statement->execute([
                    ':genre_id' => $genreId,
                    ':game_id' => $this->id
                ]);
            }
            $this->db->commit();
            return true;
        } catch (\PDOException) {
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * @return Genre[]
     */
    public function getGenres(): array
    {
        $statement = $this->db->prepare(
            'SELECT genres.* FROM genres
                    LEFT JOIN game_genre ON genres.id = game_genre.genre_id
                    LEFT JOIN games on game_genre.game_id = games.id
                    WHERE games.id = :game_id'
        );
        $statement->execute([':game_id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, "\System\Databases\Objects\Genre");
    }

    /**
     * @return array
     */
    public function getGenreIds(): array
    {
        return $this->genreIds;
    }


    /**
     * @param array $genreIds
     * @return void
     */
    public function setGenreIds(array $genreIds): void
    {
        $this->genreIds = $genreIds;
    }
}