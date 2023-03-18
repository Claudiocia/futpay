<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Campeonato.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $hora
 * @property string $data
 * @property string $valor
 * @property string $premio
 * @property int $qtd_players
 * @property string $status
 * @property string|null $arrecadacao_total
 * @property int|null $vencedor
 * @property int|null $vice
 * @property int|null $terceiro
 * @property int|null $quarto
 * @property int $plataforma_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plataforma $plataforma
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato query()
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereArrecadacaoTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato wherePlataformaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato wherePremio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereQtdPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereQuarto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereTerceiro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereVencedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereVice($value)
 * @mixin \Eloquent
 */
	class Campeonato extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class Conta.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $numero
 * @property string $saldo
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movimento> $movimentos
 * @property-read int|null $movimentos_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Conta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereUserId($value)
 * @property string $active
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereActive($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Conta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta withoutTrashed()
 */
	class Conta extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class Disputacamp.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $campeonato_id
 * @property int $player1
 * @property int $player2
 * @property int|null $golplay1
 * @property int|null $golplay2
 * @property string $data
 * @property string $hora
 * @property int|null $vencedor
 * @property string|null $url_video
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Campeonato $campeonato
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp query()
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereCampeonatoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereGolplay1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereGolplay2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp wherePlayer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp wherePlayer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereUrlVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereVencedor($value)
 * @mixin \Eloquent
 */
	class Disputacamp extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class Jogo.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $player1
 * @property int $player2
 * @property int|null $golplay1
 * @property int|null $golplay2
 * @property string $data
 * @property string $hora
 * @property int|null $vencedor
 * @property string|null $url_video
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereGolplay1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereGolplay2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo wherePlayer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo wherePlayer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereUrlVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereVencedor($value)
 * @mixin \Eloquent
 */
	class Jogo extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class Movimento.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $description
 * @property string $tipo
 * @property string $valor
 * @property string $data
 * @property int $conta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conta $conta
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereContaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereValor($value)
 * @mixin \Eloquent
 */
	class Movimento extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class Plataforma.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereUpdatedAt($value)
 * @property string $sigla
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereSigla($value)
 * @mixin \Eloquent
 */
	class Plataforma extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * Class Rachao.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $premio
 * @property string $hora
 * @property string $arrecadacao_total
 * @property string $data
 * @property int $plataforma_id
 * @property int $qtd_players
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plataforma $plataforma
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereArrecadacaoTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao wherePlataformaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao wherePremio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereQtdPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Rachao extends \Eloquent implements \Prettus\Repository\Contracts\Transformable {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $nick_game
 * @property string $phone
 * @property string $cpf
 * @property int $role
 * @property string $ativo
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|User whereAtivo($value)
 * @method static Builder|User whereCpf($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereCurrentTeamId($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNickGame($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereProfilePhotoPath($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereTwoFactorConfirmedAt($value)
 * @method static Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static Builder|User whereTwoFactorSecret($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @property-read Collection<int, Campeonato> $campeonatos
 * @property-read int|null $campeonatos_count
 * @property-read Conta|null $conta
 * @property-read Collection<int, Disputacamp> $disputacamps
 * @property-read int|null $disputacamps_count
 * @property-read Collection<int, Jogo> $jogos
 * @property-read int|null $jogos_count
 * @property-read Collection<int, Plataforma> $plataformas
 * @property-read int|null $plataformas_count
 * @property-read Collection<int, Rachao> $rachaos
 * @property-read int|null $rachaos_count
 * @property string $dt_nasc
 * @method static Builder|User whereDtNasc($value)
 * @property Carbon|null $deleted_at
 * @method static Builder|User onlyTrashed()
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User withTrashed()
 * @method static Builder|User withoutTrashed()
 * @mixin Eloquent
 */
	class User extends \Eloquent {}
}

