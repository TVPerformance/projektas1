function Row({mushroom}) {

    return (
    <li style={{color:mushroom.color}}>
     {mushroom.title} <i>{mushroom.weight} g.</i>
    </li>
    )
}

export default Row;