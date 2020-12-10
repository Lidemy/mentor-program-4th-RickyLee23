import styled from "styled-components";

const FilterWrapper = styled.div`
  margin: 0px auto;
`;
const FilterFunctions = styled.div``;
const FilterButton = styled.button`
  background: #74a38c;
  color: #d1d1c2;
  margin: 10px;
  cursor: pointer;
  &:hover {
    color: white;
  }
`;

function TodoListFilterFunction({
  handleFilterAll,
  handleFilterNotYet,
  handleFilterDone,
  handleCleanUp,
}) {
  return (
    <FilterWrapper>
      <FilterFunctions>
        <FilterButton onClick={handleFilterAll}>全部</FilterButton>
        <FilterButton onClick={handleFilterNotYet}>還沒做</FilterButton>
        <FilterButton onClick={handleFilterDone}>做完的</FilterButton>
        <FilterButton onClick={handleCleanUp}>清光光</FilterButton>
      </FilterFunctions>
    </FilterWrapper>
  );
}

export default TodoListFilterFunction;
