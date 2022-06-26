CREATE TABLE `members` (
  `num` int(11) NOT NULL,
  `id` char(15) NOT NULL,
  `pass` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `point` int(11) NULL,
  `recommend_index` int(11) NULL,
  `mylike` char(255) NULL,
  `mydownload` char(255) NULL,
  `myfriends` char(255) NULL,
  `messagefriends` char(255) NULL,
  `recommendfriends` char(255) NULL
);


INSERT INTO `members` (`num`, `id`, `pass`, `name`, `point`, `recommend_index`, `mylike`, `mydownload`, `myfriends`, `messagefriends`, `recommendfriends`) VALUES
(1, 'chris', '12345', '크리스', 1051, 0, '2,3,4,13,22,23,24,25,6', NULL, '2,3,4,6,5', 'Denis,sara,Louis,Celia', NULL),
(2, 'Denis', '12345', '데니스', 180, 1, '2,8,3,1,17,18,13,23', NULL, '1,4,6', 'chris,Celia', NULL),
(3, 'sara', '12345', '사라', 33, 1, '4,6,2,3,19,17,18,13,20,23,24', NULL, '1', 'chris', '6,4'),
(4, 'Louis', '12345', '루이스', 0, 1, '19,17,21,1,14,4,8,15,12,6,7,16', NULL, '5,1,3', 'chris', '2,6'),
(5, 'Jade', '12345', '제이드', 27, 1, '1,4,10,8,12,6,7', NULL, '4,1', NULL, '6'),
(6, 'Celia', '12345', '실리아', 85, 1, '6,7,4,2,8,25,24,23', NULL, '1,3,4,5,2', 'Denis', NULL);


CREATE TABLE `photos` (
  `num` int(11) NOT NULL,
  `id` char(15) NOT NULL,
  `title` char(15) NOT NULL,
  `content` char(200) NOT NULL,
  `reply` char(255) NULL,
  `fix_reply` int(11) NULL,
  `file_name` char(40) NOT NULL,
  `file_type` char(40) NOT NULL,
  `file_copied` char(40) NOT NULL,
  `hit` int(11) NOT NULL,
  `recommend` int(11) NULL,
  `download_hit` int(11) NOT NULL
);

INSERT INTO `photos` (`num`, `id`, `title`, `content`, `reply`, `fix_reply`, `file_name`, `file_type`, `file_copied`, `hit`, `recommend`, `download_hit`) VALUES
(1, 'Denis', '서해안사진', '서해안야경이에요!\r\n잘나온것 같아 공유해봐요!\r\n', NULL, 3, 'sea_picture.png', 'image/png', '2020_12_01_10_26_11.png', 93, 117, 100),
(2, 'Denis', '산 사진', '산에 오랜만에 등반해서 찍어본 사진이에요!', NULL, 8, 'mountain.png', 'image/png', '2020_12_01_10_30_04.png', 186, 63, 41),
(3, 'chris', '눈 사진', '눈이 예쁘게 왔길래 촬영해봤어요!\r\n정말예쁘네요', NULL, 7, 'snow.png', 'image/png', '2020_12_01_10_32_52.png', 625, 1002, 86),
(4, 'sara', '해변 사진', '해수욕장에서 촬영해봤어요!\r\n사람이 정말많네요~\r\n참고로 코로나 터지기 전이랍니다.', NULL, 4, 'beach.png', 'image/png', '2020_12_01_10_35_57.png', 463, 33, 84),
(9, 'Celia', '토끼사진', '저희 집 뒷산에 토끼가 있었네요~', NULL, 0, 'rabit.jpg', 'image/jpeg', '2020_12_05_12_57_07.jpg', 240, 85, 112),
(10, 'Jade', '고양이 사진', '저희 동네 스튜디오에서 촬영해봤어요!', NULL, 0, 'cat.jpg', 'image/jpeg', '2020_12_05_13_04_42.jpg', 142, 27, 24),
(15, 'chris', '뚱냥이 사진', '식탁에서 저러고있네요~', NULL, 0, 'cutecat.png', 'image/png', '2020_12_05_13_21_13.png', 167, 50, 77);

CREATE TABLE `reply` (
  `num` int(11) NOT NULL,
  `photoid` int(11) NOT NULL,
  `id` char(15) NOT NULL,
  `content` char(200) NOT NULL,
  `recommend` int(11) NULL
);

INSERT INTO `reply` (`num`, `photoid`, `id`, `content`, `recommend`) VALUES
(1, 4, 'chris', '해수욕장에 사람이 참 많네요! 조심히 놀다가세요!', 3),
(2, 2, 'chris', '역시 산정상에는 풍경이 장관이네요 첨부파일 잘 받아갑니다!', 4),
(3, 1, 'chris', '야경을 보니 산책이라도 나가고싶어지네요 감사합니다.', 3),
(4, 4, 'Denis', '사진을 보니 가보고싶네요ㅠㅠ', 5),
(6, 3, 'Denis', '혹시 장소가 어딘지 알수있을까요?', 5),
(7, 3, 'sara', '사진만 봐도 춥네요! 감기조심하세요!', 3),
(8, 2, 'sara', '저도 이번주에 등산하기로했어요!', 4),
(10, 4, 'Celia', '이번년도에 해수욕장 못간게 너무 아쉽네요~', 1),
(11, 1, 'Celia', '정말 좋은 시간대에 잘 가신것같네요!', 0),
(12, 2, 'Celia', '혹시 어떤 산인지 알수있을까요~?', 2),
(13, 9, 'Jade', '진짜 귀여운 토끼네요~!!', 3),
(14, 4, 'Jade', '사진으로나마 대리만족 했네요~', 1),
(15, 2, 'Jade', '역시 경치는 산 정상만한곳이 없네요', 1),
(16, 3, 'Jade', '우리나라 맞죠..?', 1),
(17, 10, 'chris', '혹시 어떤 스튜디오였는지 좌표 알 수있나요?', 3),
(18, 9, 'chris', '저도 토끼 정말 좋아해요~!', 2),
(19, 10, 'Denis', '저도 고양이 키우는데 한창 말 잘들을 때네요!', 2),
(20, 9, 'Denis', '야생 토끼인가요?', 1),
(21, 10, 'sara', '팔을 들고있는게 너무 귀엽네요!', 1),
(22, 9, 'sara', '솜뭉치 뭉쳐놓은것 같아요 !', 1),
(23, 15, 'Louis', '저러면 먹을걸 줄 수 밖에 없을거같아요ㅎㅎ', 4),
(24, 15, 'Denis', '고양이 몇살인가요!?', 3),
(25, 15, 'sara', '눈이 정말 똘망똘망하네요~', 2),
(26, 15, 'Celia', '다운로드 잘 받아갈게요~', 0);


CREATE TABLE `message` (
  `num` int(11) NOT NULL,
  `my_id` char(20) NOT NULL,
  `opponent_id` char(20) NOT NULL,
  `content` char(255) NOT NULL
);


INSERT INTO `message` (`num`, `my_id`, `opponent_id`, `content`) VALUES
(2, 'chris', 'Denis', '메세지입니다'),
(3, 'Denis', 'chris', '네 잘받았습니다.'),
(4, 'chris', 'Denis', '감사합니다.'),
(5, 'Celia', 'Denis', '안녕 데니스'),
(6, 'Denis', 'Celia', '그래 안녕 실리아'),
(7, 'Celia', 'Denis', '나 1시수업인데 지금이라도 잘까'),
(8, 'Celia', 'Denis', '하아'),
(9, 'Denis', 'Celia', '나는 지금이라도 자는게 좋다고 생각해'),
(10, 'chris', 'sara', '안녕 사라'),
(11, 'chris', 'Louis', '하이 루이스'),
(12, 'chris', 'Celia', '실리아 안녕'),
(13, 'chris', 'Celia', '오랜만이야'),
(14, 'Denis', 'chris', '혹시 사진을 어디서 구했는지 알 수 있을까요?'),
(15, 'Denis', 'Celia', '신호과제는 어떡하지..'),
(16, 'sara', 'chris', '안녕 크리스'),
(17, 'sara', 'chris', '먼저 친추 걸어줘서 고마워'),
(18, 'Louis', 'chris', '안녕 실리아~'),
(19, 'Louis', 'chris', '혹시 내일까지인 과제 완료했어?');
