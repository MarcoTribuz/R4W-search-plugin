const actions= Object.freeze({
  add: 'add',
  remove: 'remove'
})

const timeTs = Object.freeze({
  oneYear: 31556926,
})

const tagType = Object.freeze({
  tag: 'tag',
  difficulty: 'difficulty',
  duration: 'duration',
  serving: 'serving',
  domain: 'domain',
  skill: 'skill',
  intersection: 'intersection',
  dish: 'dish',
  recipe: 'recipe'
})

const difficultyList = Object.freeze({
  hard: 'hard',
  medium: 'medium',
  easy: 'easy'
})

const servingList = Object.freeze({
  '1-person': '1-person',
  '11-25-people': '11-25-people',
  '2-10-people': '2-10-people',
  '26-40-people': '26-40-people',
  '41-people': '41-people'
})

const durationList = Object.freeze({
  '1-day':'1-day',
  '1-week':'1-week',
  '1-10-minutes':'1-10-minutes',
  '11-30-minutes':'11-30-minutes',
  '31-60-minutes':'31-60-minutes',
  '61-120-minutes':'61-120-minutes',
  '121-240-minutes':'121-240-minutes',
  'half-a-day':'half-a-day',
  'ongoing':'ongoing',
})

export {
  actions,
  tagType,
  timeTs,
  difficultyList,
  servingList,
  durationList
}

